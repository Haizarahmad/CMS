@extends('layouts.superadmin')

@section('title', 'Classrooms')

@section('superadmin-content')
<div class="flex items-center justify-between h-15">
<h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Classrooms
</h2>
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
    <i class="bi bi-clipboard-plus-fill"></i>
    Add classroom
</button>
</div>
{{-- Modal for add subject --}}
@include('superadmin.classrooms.add-classroom')
@include('superadmin.classrooms.edit-classroom')
@include('superadmin.classrooms.delete-classroom')
<hr class="my-4" />
<div class="mt-4">
@include('partials.alert-message')
<table id="example">
    <thead>
        <tr>
            <th>
                Classroom name
            </th>
            <th>
                Homeroom teacher
            </th>
            <th>
                Last updated
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classrooms as $classroom)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $classroom->name }}</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $classroom->teacher->name }}</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $classroom->updated_at }}</td>
            <td>
                <button data-modal-target="edit-modal-{{ $classroom->id }}" data-modal-toggle="edit-modal-{{ $classroom->id }}" type="button" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <i class="bi bi-pencil-fill"></i>
                </button>
                <button data-modal-target="delete-modal-{{ $classroom->id }}" data-modal-toggle="delete-modal-{{ $classroom->id }}" type="button" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    <i class="bi bi-trash-fill"></i>
                </button>
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
        responsive: true
    });
</script>
@endsection