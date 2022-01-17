<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['imageable_id', 'imageable_type', 'path'];
    /**
     * Daj mi sve vlasnike koji su upotrijebili sliku
     * Taj vlasnik slike moze biti i post i korisnik
     * ! mora biti naziv f-je imageable
     */

    public function imageable()
    {
        return $this->morphTo();
    }
}