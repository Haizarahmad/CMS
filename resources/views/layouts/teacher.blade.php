@extends('layouts.main-layout')

@section('sidebar')
    @include('partials.teacher.sidebar')
@endsection

@section('content')
    @yield('teacher-content') {{-- Placeholder for teacher views --}}
@endsection