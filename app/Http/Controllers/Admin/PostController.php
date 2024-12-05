<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Interaction;
use App\Models\Post;
use App\Models\PostInteraction;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleImages;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    use HandleImages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $filter = request()->query('filter');

        $search = request()->query('search');

        $posts = Post::with('likes', 'type', 'saves')
                       ->withCount('likes');  

        //applying either filter or search       
        if(isset($filter)){

        if($filter === 'published'){
             $posts->whereNotNull('published_at');
        }
        
        else if($filter === 'unpublished'){
         $posts->whereNull('published_at');
        }
        } 
        else {
            $posts->where(function($query) use ($search){
                $query->where('title_' . app()->getLocale(), 'LIKE', '%' . $search . '%')
                     ->orWhereRelation('type', 'name', 'LIKE', '%' . $search . '%');
                     });
        }

        $posts = $posts
              ->OrderBy('created_at', 'desc')
              ->paginate(5)
              ->withQueryString();

        return view('admin.dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::select(['id', 'name'])->get();

        return view('admin.post.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try{
        DB::transaction(function() use($request){
        $post = Post::create([
            'title_en' => $request->title_en,
            'content_en' => $request->content_en,
            'type_id' => $request->type_id,
            'title_ar' => $request->title_ar ?? null,
            'content_ar' => $request->content_ar ?? null,
        ]);

        //The newly created posts are automatically not published yet
        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('private/posts/' . $post->id);

            $post->update([
                'thumbnail' => basename($path),
            ]);
         }

        });
    }catch(\Exception $exception){
        return redirect()->route('dashboard')->with('error', __('Something went wrong please try again'));
    }

    return redirect()->route('dashboard')->with('success', __('The post is created successfully'));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('type')->loadCount('likes');

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('type');

        $types = Type::get();

        return view('admin.post.edit', compact('post', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

       $this->updateImage($post, $request);

        $post->update([
            'title_en' => $request->title_en,
            'content_en' => $request->content_en,
            'type_id' => $request->type_id,
            'title_ar' => $request->title_ar,
            'content_ar' => $request->content_ar,
        ]);

     return redirect()->route('dashboard')->with('success', __('The post is updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->delete_image($post);
        
        $post->delete();

        return redirect()->back()->with('success', __('The post is deleted successfully'));
    }

     public function publish_post(Post $post)
     {

        abort_if(isset($post->published_at), 404);

        //making the image public
        if(isset($post->thumbnail)){
            Storage::move('private/posts/'. $post->id, 'public/' . $post->id);
        }

        $post->update([
            'published_at' => now()
        ]);

        return redirect()->back()->with('success', __('The post is published successfully'));

    }

    public function Unpublish_post(Post $post)
    {
        abort_if(!isset($post->published_at), 404);

        if(isset($post->thumbnail)){
            Storage::move('public/' . $post->id, 'private/posts/'. $post->id);
        }

        $post->update([
            'published_at' => null
        ]);

        //delte the post from saved posts for the users
        PostInteraction::where('post_id', $post->id)
                        ->where('interaction_id', Interaction::where('name', 'saved')->firstOrFail()->id)
                        ->delete();

        return redirect()->back()->with('success', __('The post is Unpublished successfully'));
    }
}
