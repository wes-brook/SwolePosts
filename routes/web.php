<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Pass 'myPosts' & 'otherPosts' data to the home blade template for display
Route::get('/', function () {
    $myPosts = [];
    $otherPosts = Post::with('likes')->get();

    if (Auth::check()) {
        $myPosts = Post::with('likes')->where('user_id', Auth::id())->get();
        $otherPosts = Post::with('likes')->where('user_id', '!=', Auth::id())->get();
    }

    return view('home', [
        'myPosts' => $myPosts,
        'otherPosts' => $otherPosts
    ]);
});

// User routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Post routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware('auth');
Route::post('/posts/{post}/unlike', [PostController::class, 'unlike'])->middleware('auth');
