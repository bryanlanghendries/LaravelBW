<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

use Auth;

class CommentController extends Controller
{
    public function store($postId, Request $request)
    {
        // Check if post exists and fetch it
        $post = Post::findOrFail($postId);
        // Validate the content
        $request->validate([
            'content' => 'required|string',
        ]);

        // Get the current user
        $user = Auth::user();

        // Create the comment
        Comment::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ]);

        // Redirect to current post with status confirmed
        return redirect()->route('posts.show', $post)->with('status', 'Comment Posted!');
    }
}
