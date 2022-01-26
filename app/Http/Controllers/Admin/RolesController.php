<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{

    public function index()
    {
        return view('admin.roles', [
            'roles' => Role::withTrashed()->get(),
            'permissions' => Permission::all()
        ]);
    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->role,
        ]);

        $role->permissions()->attach($request->permissions);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.roles.edit_role', [
            'role' => Role::findOrFail($id),
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role)
    {
        $inputs = request()->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role->permissions()->sync(request()->input('permissions'));
        $role->update($inputs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function remove($id)
    {
        Role::where('id', $id)->forceDelete();
        return response()->json([
            'message' => 'Role removed successfully!'
        ]);
    }

    public function restore(Role $role, $id)
    {
        $role->whereId($id)->restore();

        return response()->json([
            'message' => 'Role restored successfully!'
        ]);
    }
}
