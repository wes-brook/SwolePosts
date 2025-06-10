<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function deletePost(Post $post)
    {
        if (Auth::id() === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }

    public function updatePost(Post $post, Request $request)
    {
        if (Auth::id() != $post['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'body' => ['required'],
        ]);

        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post)
    {
        if (Auth::id() != $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'body' => ['required'],
        ]);

        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();
        Post::create($incomingFields);
        return redirect('/');
    }

    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();

        if (!$post->likedBy($user)) {
            $post->likes()->create(['user_id' => $user->id]);
        }

        if ($request->ajax()) {
            return response()->json(['liked' => true, 'likes_count' => $post->likes()->count()]);
        }
        return back();
    }

    public function unlike(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();

        $post->likes()->where('user_id', $user->id)->delete();

        if ($request->ajax()) {
            return response()->json(['liked' => false, 'likes_count' => $post->likes()->count()]);
        }
        return back();
    }

}
