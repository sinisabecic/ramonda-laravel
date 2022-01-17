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
use Illuminate\Support\Facades\Validator;
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
        //
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
        return view('admin.edit_user', [
            'user' => User::withTrashed()->findOrFail($id),
            'countries' => Country::all(),
            'roles' => Role::all(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $id, Request $request)
    {
//        $attr = request()->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
//            'email' => ['required', 'string', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8'],
//        ]);

        $user = User::withTrashed()->findOrFail($id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'address' => $request['address'],
            'country_id' => $request['country'],
        ]);
        $user->save();

        $user->photos()->create(['path' => $request['avatar']]);

        $user = User::withTrashed()->findOrFail($id);
        $user->roles()->sync($request->input('role'));

        return back()->with('success', 'User updated');
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

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('image')) {
            User::find(112)->photos()->update(['path' => $request['image']]);
        } else return false;
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

}
