<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('photos')->withTrashed()->get();
        $countries = Country::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'countries', 'roles'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'country_id' => $request->country,
            'address' => $request->address,
            'is_active' => $request->is_active,
        ]);

        $user->roles()->sync($request->roles);

        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->getClientOriginalName();
//            request()->file('avatar')->storeAs('avatars', $user->id . '/' . $avatar, '');
            Storage::putFileAs('avatars', request()->file('avatar'), $user->id . '/' . $avatar);
            $user->photo()->create(['url' => $avatar]);
        }

//        return $user;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
//        $this->authorize('view');

        return view('admin.edit_user', [
            'user' => User::findOrFail($id),
            'countries' => Country::all(),
            'roles' => Role::all(),
        ]);
    }


    public function update(User $user)
    {
        $inputs = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'is_active' => ['required'],
//            'avatar' => 'image|mimes:jpg,jpeg,tiff,png',
            'country_id' => ['string'],
            'address' => ['string'],
        ]);

        $user->roles()->sync(request()->input('roles'));
        $user->update($inputs);
    }


    public function updatePhoto(User $user)
    {
        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');
            $avatar = $file->getClientOriginalName();
            request()->file('avatar')->storeAs('avatars', $user->id . '/' . $avatar, '');
            $user->photo()->update(['url' => $avatar]);
        }
    }

    //? View page
    public function editPassword($id)
    {
        return view('admin.users.edit_password', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function updatePassword($id)
    {
        $user = User::whereId($id);

        $inputs = request()->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $inputs['password'] = Hash::make($inputs['password']);
        $user->update($inputs);
    }

    public function restore(User $user, $id)
    {
        $user->whereId($id)->restore();

        return response()->json([
            'message' => 'User restored successfully!'
        ]);
//            return redirect('/users');
//        else echo "greska";
    }


    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function remove($id)
    {
        User::find($id)->forceDelete();

        return response()->json([
            'message' => 'User deleted forever successfully!',
        ]);
    }


    public function profile(User $user)
    {
        return view('admin.users.profile', [
            'user' => $user,
            'countries' => Country::all(),
            'roles' => Role::all(),
        ]);
    }

    public function profileUpdate(User $user)
    {
        $inputs = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'country_id' => ['string'], //? name i naziv od kolone iz baze moraju da se poklapaju
            'address' => ['string'],
        ]);

        $user->update($inputs);
    }

    public function updateProfilePhoto(User $user)
    {
        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');
            $avatar = $file->getClientOriginalName();
            Storage::putFileAs('avatars', request()->file('avatar'), $user->id . '/' . $avatar);
            $user->photo()->update(['url' => $avatar]);
        }
    }

}
