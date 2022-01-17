<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Role extends Model
{

    protected $fillable = ['role_id', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
