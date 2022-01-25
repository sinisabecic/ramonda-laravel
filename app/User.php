<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
//    protected $fillable = [
//        'name', 'email', 'password', 'username', 'country_id', 'address', 'avatar'
//    ];

    //? Ova kolona se popunjava pri brisanju
    //! Soft delete
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //? I pri azuriranju korisnika, radice enkripciju. Zato je ovo pozeljno
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class) // join na na permission_id
        ->withPivot('created_at');
    }

    /**
     * The roles that belong to the user. Many To Many veza
     * // * Ovdje smo radili join na tabelu role_user
     * Nismo morali ni ovo: 'role_user', 'user_id', 'role_id'... da dopisujemo
     * jer se ovo tretira kao standard za pivot tabelu
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_id',
            'id', // join na na user_id
            'id') // join na na role_id
        ->withPivot('created_at'); //->withPivot('created_at');
    }

    public function role()
    {
        foreach (auth()->user()->roles as $role) {
            return $role;
        }
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return false;
            }
        }
        return false;
    }

    //? Jos dinamicniji nacin od getIsAdminAttribute funkcije koji samo provjerava je li admin
    public function hasRole($role_name)
    {
        if ($this->roles->where('slug', $role_name)->first()) {
            return true;
        }
        return false;
    }

    /**
     * Get the country associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id'); //? country_id je is tabele users
    }


    /**
     * Svrha ovog tipa funkcija je da se mogu izbjeci strani kljucevi poput user_id na post i sl.
     * U ovom slucaju imageable_id(imageable) mora da ima isti id kao id od korisnika
     * Pod uslovom da je to imageable_type jednak njegovom modelu, u ovom slucaj App\User
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    // Profilna slika ima jednog vlasnika
    public function photo()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    // /**
    //  * Get the address associated with the User
    //  ! Nije mi bila potrebna vise ova funkcija, zato sto je zamisao da addresa bude proizvoljna
    //  */
    // public function address()
    // {
    //     return $this->hasOne(Address::class, 'id', 'address_id'); //address_id se odnosi na users
    // }


    // Cim je morph, znaci da je vise u vise i da ima pivot tabelu
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    // Da nam se po automatizmu prikazuju imena velikim slovom
    // public function getNameAttribute($value)
    // {
    //     return strtoupper($value);
    // }


    //? Svim velikim slovima da bude ime svakom novoregistrovanom korisniku
    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = strtoupper($value);
    // }

    // * Ovo je isAdmin/is_admin funkcija
    // ! : bool znaci da je funkcija boolean tipa i da ce vratiti true/false odnosno 1/0
    // ? ovo pozivamo na isAdmin ili IsAdmin ili is_admin ili isadmin
    public function getIsAdminAttribute(): bool
    {
        return $this->roles()->where('role_id', 1)->exists(); //? kacimo se na role_user tabelu
        // 'role_id', 1 role_id = 1, a to je administrator

        //? Moj nacin
//        foreach ($this->roles as $role) {
//            if ($role->name == "administrator")
//                return true;
//        }
//        return false;

        //? Jos jedan nacin
//        return in_array(1, $this->roles()->pluck('role_id')->all());

        //? I jos jedan
//        return $this->roles()->where('role_id', 1)->first();


    }


}
