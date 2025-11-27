<!-- set slot variable -->
@extends('layouts.app')

@section('header')
<h1 class="text-2xl font-bold">Projekti</h1>
@endsection
@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold">Projekti</h1>
</div>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @if ($projects->isEmpty())
        <div class="p-4">
            <h2 class="text-lg font-bold">Nema projekata</h2>
        </div>
        @else
        @foreach ($projects as $project)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-bold"><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></h2>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection