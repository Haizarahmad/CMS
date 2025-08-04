@extends('layouts.superadmin')

@section('title', 'Subjects')

@section('superadmin-content')
<div class="flex items-center justify-between h-15">
<h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Subjects
</h2>
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
    <i class="bi bi-clipboard-plus-fill"></i>
    Add subject
</button>
</div>
{{-- Modal for add subject --}}
@include('superadmin.subjects.add-subject')
@include('superadmin.subjects.edit-subject')
@include('superadmin.subjects.delete-subject')
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
                Created At
            </th>
            <th>
                Last Updated
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $subject->name }}</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $subject->created_at }}</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $subject->updated_at }}</td>
            <td>
                <button  data-modal-target="edit-modal-{{ $subject->id }}" data-modal-toggle="edit-modal-{{ $subject->id }}" type="button" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <i class="bi bi-pencil-fill"></i>
                </button>
                <button data-modal-target="delete-modal-{{ $subject->id }}" data-modal-toggle="delete-modal-{{ $subject->id }}" type="button" class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
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