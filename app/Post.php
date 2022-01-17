<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id', 'path'];
    // protected $table = 'posts'; // pod uslovom da naziv modela nije Post nego neko dr ime
    // protected $primaryKey = 'post_id'; // za slucaj da je ovaj naziv primarnog kljuca

    //? za SoftDeletes
    //? Pri pozivu delete(), popunjava se ova kolona
    protected $dates = ['deleted_at'];

    public $directory = '/uploads/';

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }


    // taggable_id mu dodje kao id od posta
    // tag_id je id iz tabele tags
    //? morphMany vise u vise za polimorfne relacije
    //? morphToMany vise u vise - || -

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function getPathAttribute($value)
    {
        return $this->directory . $value;
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'asc')->get();
    }
}