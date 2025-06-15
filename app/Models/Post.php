<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Laravel assumes the db its connected to contains a table like "posts" (case-insensitive)
class Post extends Model
{
    // protected $fillable = ['title', 'body', 'user_id'];
    protected $fillable = ['body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function likedBy($user)
    {
        if (!$user)
            return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
