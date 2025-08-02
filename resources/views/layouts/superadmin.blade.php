@extends('layouts.main-layout')

@section('sidebar')
    @include('partials.superadmin.sidebar')
@endsection

@section('content')
    @yield('superadmin-content')
@endsection