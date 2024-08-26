<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eterna Blog')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .profile-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            line-height: 40px;
        }
        .dropdown-menu {
            min-width: 150px;
        }
    </style>
    @yield('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Eterna Blog</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">Create Post</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('posts.my') }}">My Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.create') }}">Create Category</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
        @auth
            <ul class="navbar-nav me-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle profile-icon" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<footer class="bg-light py-4 mt-4">
    <div class="container text-center">
        <p>&copy; {{ date('Y') }} Eterna Blog. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@yield('scripts')
</body>
</html>
