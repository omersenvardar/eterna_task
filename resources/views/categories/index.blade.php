@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="container mt-4">
        <h1 class="text-4xl font-bold mb-4">Categories</h1>

        <form action="{{ route('categories.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')

            @forelse ($categories as $category)
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">

                        <a href="{{ route('categories.index', $category) }}" class="text-decoration-none text-primary">{{ $category->name }}</a>

                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input">
                    </li>
                </ul>
            @empty
                <p class="text-muted">No categories available.</p>
            @endforelse

            @if ($categories->isNotEmpty())
                <div class="mt-4">
                    <button type="submit" class="btn btn-danger">Delete Selected Categories</button>
                </div>
            @endif
        </form>
    </div>
@endsection
