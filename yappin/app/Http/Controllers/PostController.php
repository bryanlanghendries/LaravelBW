<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Auth;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('index')->with('status', 'Yapp posted');
    }

    public function edit($id) {
        $post = Post::findOrFail($id);

        if($post->user_id != Auth::user()->id){
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update($id, Request $request) {
        $post = Post::findOrFail($id);
    
        if ($post->user_id != Auth::user()->id) {
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

    public function show($id) {
     $post = Post::findOrFail($id);
     return view('posts.show', compact('post'));
    }

    public function destroy($id) {

        // Find post by id
        $post = Post::findOrFail($id);

        // Check if admin or owner of post
        if(!Auth::user()->is_admin && Auth::user()->id !== $post->user_id){
            abort(403, 'You are not  authorized to remove this Yapp');
        }

        // Delete all likes from post
        Like::where('post_id', '=' , $post->id)->delete();

        // Delete post
        $post->delete();

        // Return to index page with status
        return redirect()->route('index')->with('status','Yapp deleted');
    }

}
