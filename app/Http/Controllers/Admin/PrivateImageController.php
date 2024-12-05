<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Faker\Core\File;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrivateImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, $name)
    {
        $path = 'private/posts/' . $post->id . '/' . $name;

        if(!Storage::exists($path)){
            abort(404);
        }

        return Storage::response($path);
    }
}
