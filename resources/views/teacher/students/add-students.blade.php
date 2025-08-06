@extends('layouts.teacher')

@section('title', 'Add new student')
@section('teacher-content')
<div class="flex items-center justify-between h-15">
<h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Add new student
</h2>
<form method="POST" action="{{ route('students.upload_ocr') }}" enctype="multipart/form-data">
    @csrf
    <div class="flex gap-3">
    <input type="file" name="document" accept=".pdf" required
        class="text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
    <button type="submit"
        class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <i class="bi bi-upc-scan"></i>
        Scan Document
    </button>
    </div>
</form>
</div>
<hr class="my-4" />
<div class="mt-4">
@include('partials.alert-message')
<form method="POST" action="{{ route('students.post') }}" enctype="multipart/form-data">
    @csrf
    @include('teacher.students.add-profile-img')
    <div class="flex items-center justify-center mb-6">
        <div class="relative w-50 h-50">
            <div class="w-50 h-50 rounded-full bg-blue-500 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
            </div>
            <button type="button"
                data-modal-target="default-modal"
                data-modal-toggle="default-modal"
                class="absolute bottom-0 right-2 w-10 h-10 text-white bg-blue-700 mt-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-camera-fill"></i>
            </button>
        </div>
    </div>        
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student name</label>
            <input type="text" value="{{ old('name', $studentData['name'] ?? '') }}" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" value="{{ old('email', $studentData['email'] ?? '') }}"  name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe@gmail.com" required />
        </div>
        <div>
            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of birth</label>
            <input type="date" value="{{ old('date_of_birth', $studentData['date_of_birth'] ?? '') }}"  name="date_of_birth" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite" required />
        </div>  
        <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
            <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="male" {{ old('gender', $studentData['gender'] ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $studentData['gender'] ?? '') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
    </div>
    <div class="mb-6">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <input type="text" value="{{ old('address', $studentData['address'] ?? '') }}" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="51, Lorong Cahaya Damai, Kuching, Sarawak" required />
    </div>
    @php
    $ocrSubjects = session('ocr_data.subjects', []);
    @endphp
    <div>
        <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjects</label>
        <div class="grid grid-cols-3 gap-6">
            @foreach ($subjects as $subject)
                @php
                    $isChecked = isset($studentData['subjects']) && in_array($subject->id, $studentData['subjects']);
                @endphp
                <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                    <input id="subject-{{ $subject->id }}" type="checkbox" value="{{ $subject->id }}" name="subjects[]"
                        {{ $isChecked ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="subject-{{ $subject->id }}" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ $subject->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 mt-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
</form>


</div>
@endsection