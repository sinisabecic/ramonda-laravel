<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function commentable()
    {
        return $this->morphTo();
    }

    // Proba
    // public function post()
    // {
    //     return $this->morphTo(Post::class, 'commentable');
    // }

    // public function video()
    // {
    //     return $this->morphTo(Video::class, 'commentable');
    // }
}