<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
//        if ($user->hasRole('admin'))
//            return true;
//        if ($user->hasRole('head'))
//            return true;
//        if ($user->hasRole('moderator'))
//            return true;
//        if ($user->hasRole('partner'))
//            return true;
//        if ($user->hasRole('guest'))
//            return true;
//        return $user->id == $model->id
//            ? Response::allow()
//            : Response::deny('You do not have permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function updateProfile(User $user, User $model)
    {
        return $user->hasRole('partner') ||
        $user->hasRole('user') ||
        $user->hasRole('author') ?: $user->id == $model->id;
    }

    public function remove(User $user, User $model)
    {
        return $user->hasRole('admin') ?: $user->id == $model->id;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}