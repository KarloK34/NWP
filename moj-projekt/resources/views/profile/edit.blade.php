@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Profile') }}
</h2>
@endsection
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Owned Projects') }}
                </h2>
            </div>
            <div class="max-w-xl">
                @foreach ($owned as $project)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-bold">{{ $project->name }}</h3>
                </div>
                @endforeach
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Member Projects') }}
                </h2>
            </div>
        </div>
        <div class="max-w-xl">
            @foreach ($member as $project)
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-bold">{{ $project->name }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection