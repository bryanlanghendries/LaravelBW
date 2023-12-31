<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Auth;

class PostController extends Controller
{

    public function __construct()
    {
        // Protect all except index and show
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        // Get all posts sorted by date (DESC)
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate data
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        // If not validated return with failed.
        if (!$validated) {
            return redirect()->route('index')->with('status', 'Yapp not posted');
        }

        // Else create new post
        $post = new Post;

        // Check if image has been selected
        if ($request->hasFile('cover')) {
            $coverImagePath = $request->file('cover')->store('public/covers');
            $post->cover_image = str_replace('public/', '', $coverImagePath);
        }

        // Add validated data to new post
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        // Save post
        $post->save();

        return redirect()->route('index')->with('status', 'Yapp posted');
    }

    public function edit($id)
    {
        // Find post by id
        $post = Post::findOrFail($id);

        // Check if admin or owner of post
        if ($post->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update($id, Request $request)
    {
        // Find post or abort
        $post = Post::findOrFail($id);

        // Check if admin or owner of post
        if ($post->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        // Check if the content has changed
        if ($post->title != $validated['title'] || $post->content != $validated['content']) {
            $post->title = $validated['title'];
            $post->content = $validated['content'];
            $post->is_edited = true;
            $post->save();
            return redirect()->route('index')->with('status', 'Yapp edited');

        } else {
            // Content hasn't changed, so no need to update
            return redirect()->route('index')->with('status', 'No changes were made');
        }
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        // Find post by id
        $post = Post::findOrFail($id);

        // Check if admin or owner of post
        if (!Auth::user()->is_admin && Auth::user()->id !== $post->user_id) {
            abort(403, 'You are not  authorized to remove this Yapp');
        }

        // Delete all likes from post
        Like::where('post_id', '=', $post->id)->delete();

        // Delete all comments from post
        Comment::where('post_id', '=', $post->id)->delete();

        // Delete post
        $post->delete();

        // Return to index page with status
        return redirect()->route('index')->with('status', 'Yapp deleted');
    }

}
