@extends('layouts.teacher')

@section('title', 'Add new student')

@section('teacher-content')
<div class="flex items-center justify-between h-15">
<h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Add new student
</h2>
</div>
<hr class="my-4" />
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="mt-4">
<form method="POST" action="{{ route('students.post') }}">
    @csrf
    <div class="flex items-center justify-center mb-6">
        <div class="bg-blue-500 w-50 h-50 rounded-full"></div>
    </div>        
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe@gmail.com" required />
        </div>
        <div>
            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of birth</label>
            <input type="date" name="date_of_birth" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite" required />
        </div>  
        <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
            <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
    </div>
    <div class="mb-6">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="51, Lorong Cahaya Damai, Kuching, Sarawak" required />
    </div>
    <div>
        <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjects</label>
        <div class="grid grid-cols-3 gap-6">
            @foreach ($subjects as $subject)
            <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                <input id="{{ $subject->id }}" type="checkbox" value="{{ $subject->id }}" name="subjects[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-checkbox-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $subject->name }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 mt-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
</form>


</div>
@endsection