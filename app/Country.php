<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * Get all of the posts for the Country
     * Daj mi postove iz trazene zemlje. Kako countries i posts nisu u nikakvoj direktnoj vezi
     * posredstvom stranih kljuceva, mi mozemo da im pristupimo preko tabele users, da bi dosli do njih
     * Korisnik ima svoju zemlju i on je autor posta. Post je dakle iz zemlje autora posta
     *! Ovo je u sustini join
     */
    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class, 'country_id', 'user_id');
    }
    // ili preglednije ovako:
    // return $this->hasManyThrough(
    //     'App\Post',
    //     'App\User',
    //     'country_id', //? Foreign key on users table...
    //     'user_id', //? Foreign key on posts table...
    //     'id', //? Local key on countries table...
    //     'id' //? Local key on users table...
    // );


    //! Laravel debugbar drasticno pomaze da se dobar eloquent napise, jer prikazuje citav sql upit.
    /**
     * Get all of the users for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
    }

    //? Get all of the cities for the Country
    public function cities()
    {
        return $this->hasMany(City::class);

        //? Za php artisan tinker
//        $countryWithCity = Country::with('city')->findOrFail($id);
    }
}
