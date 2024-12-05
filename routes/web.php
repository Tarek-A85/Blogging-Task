<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PrivateImageController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\PostViewController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\PostInteractionController;
use Illuminate\Support\Facades\Route;


Route::get('change/language/{lang}', LanguageController::class)->whereIn('lang', ['ar', 'en'])
                                                               ->name('change_lang');

Route::middleware('app_lang')->group(function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::view('contact/us', 'contact-us')->name('contact_us');

Route::controller(PostViewController::class)->middleware('no_admin')->group(function(){
    Route::get('posts', 'index')->name('all_posts');
    Route::get('posts/{post}', 'show')->name('published_post_details');
});

Route::middleware('auth')->group(function () {
    Route::middleware('check_user')->group(function(){
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::controller(PostInteractionController::class)->group(function(){
            Route::get('like/{post}', 'like')->name('like_post');
            Route::get('save/{post}', 'save')->name('save_post');
            Route::get('saved/posts', 'saved_posts')->name('saved_posts');

        });
    });
   

    //handling the access to private images (Unpublished posts)
    Route::get('storage/posts/{post}/{name}', PrivateImageController::class)->name('private_image')->middleware('check_admin');
    
    Route::middleware('check_admin')->prefix('admin')->group(function(){
        Route::get('dashboard', [PostController::class, 'index'])->name('dashboard');
        Route::get('publish/post/{post}', [PostController::class, 'publish_post'])->name('publish_post');
        Route::get('unpublish/post/{post}', [PostController::class, 'Unpublish_post'])->name('unpublish_post');
        Route::resource('post', PostController::class)->except('index');

        Route::resource('type', TypeController::class)->except('show');
        
    });
});

});

require __DIR__.'/auth.php';
