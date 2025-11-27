<!-- prikaz projekta s članovima tima -->

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold">{{ $project->name }}</h1>
</div>
<div class="bg-white shadow-md rounded-lg p-4 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p>Opis projekta: {{ $project->description }}</p>
    </div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p>Cijena projekta: {{ $project->price }}</p>
    </div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p>Datum početka: {{ $project->start_date }}</p>
    </div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p>Datum završetka: {{ $project->end_date }}</p>
    </div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p>Završeni zadaci: {{ $project->completed_tasks }}</p>
    </div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="font-semibold">Voditelj projekta:</p>
        <p class="mb-4">{{ $project->owner->name }}</p>
        <p class="font-semibold">Članovi projekta:</p>
        <ul>
            @foreach ($project->members as $member)
            <li>{{ $member->name }}@if($member->id === $project->owner_id) <span class="text-gray-500">(Voditelj)</span>@endif</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-center items-center gap-12 flex-wrap">
        <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ažuriraj projekt</a>
        <form action="{{ route('projects.destroy', $project) }}" method="post" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Obriši projekt</button>
        </form>
        <a href="{{ route('projects.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Nazad na popis projekata</a>
    </div>
</div>
@endsection