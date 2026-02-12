@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @if ($role === 'admin')
        @include('component.dashboard-admin')
    @else
        @if ($usaha->isEmpty())
            @include('component.empty-dashboard')
        @else
            @include('component.dashboard-user')
        @endif

    @endif

@endsection
