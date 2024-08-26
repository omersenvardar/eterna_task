@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md border border-gray-200">
        <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $post->title }}</h1>
        <div class="prose prose-gray">
            <p>{{ $post->body }}</p>
        </div>
        <a href="{{ route('posts.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Back to Posts</a>
    </div>
@endsection
