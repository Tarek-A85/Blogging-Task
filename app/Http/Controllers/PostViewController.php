<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostViewController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        //getting all the published posts sorted by newest
        // and apply the search if found
        $posts = Post::with('likes', 'type', 'saves')
                       ->withCount('likes')
                       ->whereNotNull('published_at')

                       ->where(function($query) use ($search){
                        $query->where('title_' . app()->getLocale(), 'LIKE', '%' . $search . '%')
                        ->orWhereRelation('type', 'name', 'LIKE', '%' . $search . '%');
                       })

                       ->OrderBy('published_at', 'desc')
                       ->paginate(5)
                       ->withQueryString();

        return view('post.index', compact('posts', 'search'));

    }

    public function show(Post $post){

        abort_unless($post->published_at, 404);

        $post->load('type')->loadCount('likes');

        return view('post.show', compact('post'));
    }
    
}
