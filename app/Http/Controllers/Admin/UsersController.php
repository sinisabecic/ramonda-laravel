<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (auth()->user()->hasRole('Administrator'))
        $users = User::withTrashed()->get();
        $countries = Country::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'countries', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'country_id' => $request->country,
            'address' => $request->address,
            'avatar' => 'user.jpg',
        ]);

        $user->roles()->sync($request->roles);

        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->storeAs('avatars', $user->id . '/' . $avatar, '');
            $user->update(['avatar' => $avatar]);
        }

//        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update(User $user)
    {
        $inputs = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'min:8'],
            'avatar' => 'image|mimes:jpg,jpeg,tiff,png',
            'country_id' => ['string'], //? name i naziv od kolone iz baze moraju da se poklapaju
            'address' => ['string'],
        ]);


        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');
            $avatar = $file->getClientOriginalName();
            request()->file('avatar')->storeAs('avatars', $user->id . '/' . $avatar, '');
            $inputs['avatar'] = $avatar;
        }
        $user->roles()->sync(request()->input('roles'));
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

    // ! Za test
    public function upload(User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255',],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['file'],
        ]);
//        $user = User::withTrashed()->findOrFail($id)->update([
//            'name' => $request['name'],
//            'email' => $request['email'],
//            'username' => $request['username'],
//            'address' => $request['address'],
//            'country_id' => $request['country'],
//        ]);
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $avatar = $file->getClientOriginalName();
            request()->file('image')->storeAs('avatars', $user->id . '/' . $avatar, '');
            $attributes['avatar'] = $avatar;
        }
        $user->update($attributes);
        return redirect()->back();
    }


    public function destroy(User $user)
    {
        $user->delete();
//            return redirect('/users');

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function remove($id)
    {
        User::where('id', $id)->forceDelete();
//        $user->forceDelete();
//            return redirect('/users');

        return response()->json([
            'message' => 'User deleted forever successfully!'
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

}
