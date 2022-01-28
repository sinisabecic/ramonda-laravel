<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $guarded = [];

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
