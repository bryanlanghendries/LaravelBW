<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

use Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store($postId, Request $request){
        $post = Post::findOrFail($postId);
        $user = Auth::user();
        $comment = new Comment();

        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->content = $request->get("content");
        $comment->save();

        return Redirect::back()->with('status','Comment Posted !');
    }
}
