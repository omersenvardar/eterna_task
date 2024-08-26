@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container mt-4">
        <h1 class="text-4xl font-bold mb-6">Create New Category</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Category</button>
        </form>

        <a href="{{ route('categories.index') }}" class="mt-4 d-block text-primary">Back to Categories</a>
    </div>
@endsection
