<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    //
    public function commentable()
    {
        return $this->morphTo();
    }

//    public function replies()
//    {
//        return $this->hasMany(Comment::class, 'parent_id');
//    }

    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
