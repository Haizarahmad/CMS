@extends('layouts.teacher')

@section('title', 'Teacher-Dashboard')

@section('teacher-content')
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>
    <span>
        Classroom: 
    </span>
    <div class="grid grid-cols-3 gap-6 mt-4">

    {{-- card 1 --}}
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"></div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total students</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            6389
            </p>
        </div>
    </div>
    {{-- card 2 --}}
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"></div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Student Attendance</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            80%
            </p>
        </div>
    </div>
    {{-- card 3 --}}
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"></div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Student absence</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            6389
            </p>
        </div>
    </div>

    </div>
@endsection