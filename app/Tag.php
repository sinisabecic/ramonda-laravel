<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all of the posts that are assigned this tag.
     * Kao u slucaju belongsToMany. Tagovi pripadaju postovima koji sadrze
     * svoje tagove
     * ! taggable_id mu dodje kao id od posta, tag_id je id iz tabele tags
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }


    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
