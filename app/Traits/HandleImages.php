<?php

namespace App\Traits;

use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

trait HandleImages{


    public function updateImage(Post $post, UpdatePostRequest $request){

        if($request->filled('remove_image') || $request->hasFile('thumbnail') ){

            if(!isset($post->published_at)){
                Storage::deleteDirectory('private/posts/' . $post->id);

                if($request->hasFile('thumbnail')){
                    $path =basename($request->file('thumbnail')->store('private/posts/' . $post->id));
                }
            }
            else{
                Storage::deleteDirectory('public/' . $post->id);

                if($request->hasFile('thumbnail')){
                    $path =basename($request->file('thumbnail')->store('public/' . $post->id));
                }
            }

            $post->update([
                'thumbnail' => $path ?? null,
               ]);
        }
    }

    public function delete_image(Post $post)
    {
        
        if(isset($post->published_at)){
            Storage::deleteDirectory(public_path($post->id));
        } 
        else{
            Storage::deleteDirectory('posts/' . $post->id);
        }

    }


}