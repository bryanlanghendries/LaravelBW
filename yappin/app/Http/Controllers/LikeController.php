<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

use Auth;

class LikeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function like($postId, Request $request){
        $post = Post::findOrFail($postId);
        $user = Auth::user();
    
        // Check if the user has already liked the post
        $existingLike = Like::where('post_id', $postId)->where('user_id', $user->id)->first();
    
        if (!$existingLike) {
            // If the user hasn't liked the post, create a new like
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $postId;
            $like->save();
        }
    
        return redirect()->route('index');
    }
    
}
