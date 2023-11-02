<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;

use Auth;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function like(Post $post)
    {
        $user = Auth::user();

        // Check if the user has already liked the post
        $existingLike = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        if (!$existingLike) {
            // If the user hasn't liked the post, create a new like
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);

            return back()->with('status', 'Yapp Liked !');
        } else {
            // Else delete the like
            $existingLike->delete();
            return back()->with('status', 'Yapp Disliked !');
        }


    }

}
