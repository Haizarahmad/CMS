@extends('layouts.teacher')

@section('title', 'Students')

@section('teacher-content')
<div class="flex items-center justify-between h-15">
<h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Students
</h2>
@include('teacher.students.delete-students')
<a href="{{  route('students.add') }}" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
    <i class="bi bi-person-fill-add"></i>
    Add student
</a>
</div>
<hr class="my-4" />
<div class="mt-4">
@include('partials.alert-message')
<table id="example">
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Gender
            </th>
            <th> 
                Email
            </th>
            <th class="flex justify-center">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $student->name }}</td>
            <td>{{ $student->gender }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <div class="flex gap-2 justify-center">
                <a href="{{ route('students.edit',$student->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <button data-modal-target="delete-modal-{{ $student->id }}" data-modal-toggle="delete-modal-{{ $student->id }}" type="button" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    <i class="bi bi-trash-fill"></i>
                </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>




</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.5/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.5/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example', {
        responsive: true,
    });
</script>
@endsection