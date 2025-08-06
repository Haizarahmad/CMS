<?php

use App\Http\Controllers\OCRController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/add', [StudentController::class, 'addStudentPage'])->name('students.add');
    Route::post('/students/add', [StudentController::class, 'postStudent'])->name('students.post');
    Route::get('/students/{id}', [StudentController::class, 'editStudentPage'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/delete', [StudentController::class, 'deleteStudent'])->name('students.delete');
    Route::post('/student/add/ocr', [OCRController::class, 'uploadAndExtract'], )->name('students.upload_ocr');
});
