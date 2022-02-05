<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $table = 'comment_replies';
    protected $guarded = [];

    public function comment()
    {
        $this->belongsTo(Comment::class);
    }
}
