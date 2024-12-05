<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use App\Models\Post;
use App\Models\PostInteraction;
use Illuminate\Http\Request;

class PostInteractionController extends Controller
{
   /**
    * adding a like if it is not already liked
    * if so , remove the like
    */
    public function like(Post $post)
    {
      abort_if(is_null($post->published_at), 404);

      $user = auth()->user();

     $already_liked = $user->liked_posts()->where('post_id', $post->id)->first();

     if(isset($already_liked)){
        $already_liked->delete();
     }
     else{

        PostInteraction::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'interaction_id' => Interaction::where('name', 'liked')->firstOrFail()->id,
        ]);
     }

     return redirect()->back();
    }

    /**
     * Saving the post if it is not already saved,
     * if so, Un save it
     */

    public function save(Post $post)
    {
      abort_if(is_null($post->published_at), 404);

      $user = auth()->user();

     $already_saved = $user->saved_posts()->where('post_id', $post->id)->first();

     if(isset($already_saved)){
        $already_saved->delete();
     }
     else{

        PostInteraction::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'interaction_id' => Interaction::where('name', 'saved')->firstOrFail()->id,
        ]);
     }

     return redirect()->back();

    }

    

    public function saved_posts()
    {
       $user = auth()->user();

       $user->load('saved_posts.post')->paginate(5);

       $saves = $user->saved_posts;

       return view('post.saved', compact('saves'));

    }
}
