@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold">Kreiraj projekt</h1>
</div>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Naziv projekta</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Opis projekta</label>
            <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Cijena projekta</label>
            <input type="number" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Datum početka</label>
            <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Datum završetka</label>
            <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="members" class="block text-sm font-medium text-gray-700 mb-2">Članovi projekta</label>
            <p class="text-sm text-gray-500 mb-2">Držite Ctrl (ili Cmd na Mac) za odabir više korisnika. Voditelj projekta će automatski biti dodan kao član.</p>
            <select name="members[]" id="members" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" multiple size="8">
                @foreach ($users as $user)
                @if ($user->id !== auth()->user()->id)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="flex justify-center mx-auto py-6 px-full sm:px-6 lg:px-8 mt-4 mb-4">
            <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded-md text-lg">Kreiraj projekt</button>
        </div>
    </form>
</div>
@endsection