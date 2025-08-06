<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OCRController extends Controller
{
    public function uploadAndExtract(Request $request){
        
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:20480', // Added max size limit (20MB)
        ]);

        $file = $request->file('document');
        $filePath = $file->getRealPath();
        
        // File Validation //
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return back()->withErrors(['document' => 'File could not be read.']);
        }

        $fileData = file_get_contents($filePath);
        
        if ($fileData === false) {
            return back()->withErrors(['document' => 'Failed to read file contents.']);
        }

        $apiKey = env('AZURE_OPENAI_API_KEY');
        $endpoint = env('AZURE_OPENAI_ENDPOINT');

        // Create post request //
        try {

            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => $apiKey,
                'Content-Type' => 'application/pdf',
            ])->send('POST', "{$endpoint}/contentunderstanding/analyzers/prebuilt-documentAnalyzer:analyze?api-version=2025-05-01-preview", [
                'body' => $fileData,
            ]);
        

            $ocr = $response->json();
            $requestId = $ocr['id'] ?? null;

            $result = null;
            $maxRetries = 10;
            $delaySeconds = 2;

            for ($i = 0; $i < $maxRetries; $i++) {
                sleep($delaySeconds); // wait before polling

                // Create GET request and check status //
                $pollResponse = Http::withHeaders([
                    'Ocp-Apim-Subscription-Key' => $apiKey,
                ])->get("{$endpoint}/contentunderstanding/analyzerResults/{$requestId}?api-version=2025-05-01-preview");

                if (isset($pollResponse['status']) && $pollResponse['status'] === 'Succeeded') {
                    $result = $pollResponse['result'];
                    break;
                }
            }

            $markdown = ($result['contents'][0]['markdown']);
            $data = $this->extractDataFromMarkdown($markdown);
            session()->flash('success', 'OCR uploaded successfully');
            return view('teacher.students.add-students', [
                'studentData' => $data,
                'subjects' => Subject::all()
            ]);

        } catch (\Exception $e) {
            Log::error('OCR Processing Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return back()->withErrors(['document' => 'An error occurred while processing the document.']);
        }
    }

    private function extractDataFromMarkdown($markdown){

        $data = [];
        $subjectList = Subject::all(['id', 'name'])->toArray();
        preg_match('/Student Name<\/th>\n<th>(.*?)<\/th>/', $markdown, $nameMatch);
        preg_match('/Date of birth<\/th>\n<th>(.*?)<\/th>/', $markdown, $dobMatch);
        preg_match('/Email<\/td>\n<td>(.*?)<\/td>/', $markdown, $emailMatch);
        preg_match('/Gender<\/td>\n<td>(.*?)<\/td>/', $markdown, $genderMatch);
        preg_match('/Address<\/td>\n<td colspan="3">(.*?)<\/td>/', $markdown, $addressMatch);
        preg_match_all('/\d+\\\\\.\s*\n(.+?)(?=\n\d+\\\\\.|\z)/s', $markdown, $subjectMatches);

        $extractedSubjects = array_map('trim', $subjectMatches[1] ?? []);

        $matchedSubjectIds = [];

        foreach ($extractedSubjects as $subjectName) {
                foreach ($subjectList as $subject) {
                    if (strcasecmp(trim($subject['name']), $subjectName) === 0) {
                        $matchedSubjectIds[] = $subject['id'];
                        break;
                    }
                }
            }

        $data['name'] = $nameMatch[1] ?? '';
        $data['date_of_birth'] = $dobMatch[1] ?? '';
        $data['email'] = $emailMatch[1] ?? '';
        $data['gender'] = strtolower($genderMatch[1] ?? '');
        $data['address'] = $addressMatch[1] ?? '';
        $data['subjects'] = $matchedSubjectIds;
        return $data;
    }
}
