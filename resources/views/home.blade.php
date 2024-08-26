@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to Eterna Blog</h1>
            <p class="lead">Stay ahead of the curve with our latest posts. Discover fresh content and insights to keep you informed daily.</p>
        </div>
    </div>

    <div class="container">
        <h2 class="my-4">Latest Posts</h2>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ \Str::limit($post->body, 100) }}</p>
                            <p class="text-gray-600">Posted by: {{ $post->user->name }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>

                                <button id="subscribeBtn{{ $post->id }}" class="btn btn-success" onclick="handleSubscription({{ $post->id }}, {{ $post->user->id }})">Subscribe</button>
                            </div>

                            <form action="{{ route('subscribe') }}" method="POST" style="display:none;" id="subscriptionForm{{ $post->id }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $post->user->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <label for="email{{ $post->id }}">Email:</label>
                                <input type="email" id="email{{ $post->id }}" name="email" required class="border p-2 rounded-lg">
                                <button type="submit" class="btn btn-success mt-2">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No posts available.</p>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-6">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <script>
        let currentlyVisibleForm = null;
        let isFormVisible = false;

        function handleSubscription(postId, userId) {
            const form = document.getElementById('subscriptionForm' + postId);
            const emailInput = document.getElementById('email' + postId);
            const button = document.getElementById('subscribeBtn' + postId);

            if (!isFormVisible) {
                if (currentlyVisibleForm && currentlyVisibleForm !== form) {
                    currentlyVisibleForm.style.display = 'none';
                }

                form.style.display = 'block';
                button.innerText = 'Gönder';
                currentlyVisibleForm = form;
                isFormVisible = true;
            } else {
                if (emailInput.value.trim() === '') {
                    alert('Lütfen geçerli bir e-posta adresi girin.');
                } else {
                    form.submit();
                    disableOtherButtons(postId);
                }
            }
        }

        function disableOtherButtons(exceptPostId) {
            const buttons = document.querySelectorAll('button[id^="subscribeBtn"]');

            buttons.forEach(button => {
                if (button.id !== 'subscribeBtn' + exceptPostId) {
                    button.disabled = true;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                footer: 'Please check your input and try again.'
            });
            @endif

            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                footer: 'Thank you for your message.'
            });
            @endif
        });
    </script>
@endsection
