<!DOCTYPE html>
<html>
<head>
    <title>New Post Published</title>
</head>
<body>
<h1>{{ $post->title }}</h1>
<p>{{ $post->body }}</p>
<p><a href="{{ url('/posts/' . $post->id) }}">View Post</a></p>

<p><a href="{{ url('/unsubscribe/' . urlencode($subscription->email)) }}">Unsubscribe</a></p>
</body>
</html>
