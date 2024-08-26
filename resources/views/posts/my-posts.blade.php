@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-900">Posts</h1>

        @if($posts->isEmpty())
            <p class="text-gray-600">No posts available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 flex flex-col space-y-4 h-full">
                        <div class="flex-1">
                            <h5 class="text-xl font-semibold mb-2">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
                            </h5>
                            <p class="text-gray-600 mb-2">{{ \Str::limit($post->body, 100) }}</p>
                            <p class="text-gray-600">Posted by: {{ $post->user->name }}</p>
                        </div>
                        <div class="flex justify-between mt-4 space-x-4">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-6">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
