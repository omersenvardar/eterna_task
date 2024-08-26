@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-4xl font-bold mb-4">Profile</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p><strong class="font-bold">Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong class="font-bold">Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>
@endsection
