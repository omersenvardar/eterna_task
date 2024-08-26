@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Posts</h1>

        @if($posts->isEmpty())
            <p class="text-gray-600">No posts available.</p>
        @else
            <ul class="space-y-4">
                @foreach($posts as $post)
                    <li class="border p-4 rounded bg-white shadow">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600 mb-2">Category: {{ $post->category->name }}</p>
                        <p class="mb-2">
                            {{ Str::limit(strip_tags($post->body), 300, '...') }}
                        </p>
                        @if(strlen($post->body) > 300)
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">Read More</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
