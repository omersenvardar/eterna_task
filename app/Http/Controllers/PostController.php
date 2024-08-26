<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\PostPublished;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category')->paginate(5);

        return view('home', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        $slug = Str::slug($request->title);
        $slugBase = $slug;
        $postCount = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $postCount++;
        }
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'slug' => $slug,
        ]);
        event(new PostPublished($post));

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        $post = Post::findOrFail($id);
        $slug = Str::slug($request->title);
        $slugBase = $slug;
        $postCount = 1;

        while (Post::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $slug = $slugBase . '-' . $postCount++;
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->slug = $slug;
        $post->save();

        return redirect()->route('posts.my')->with('success', 'Post updated successfully.');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.my')->with('success', 'Post deleted successfully.');
    }
    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())->paginate(5);
        return view('posts.my-posts', compact('posts'));
    }
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
