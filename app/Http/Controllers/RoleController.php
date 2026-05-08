<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
      public function __construct()
    {
       // $this->middleware('permission:role_create')->only(['create','store']);
       // $this->middleware('permission:role_edit')->only(['edit','update']);
       // $this->middleware('permission:role_delete')->only(['destroy']);
       // $this->middleware('permission:role_view')->only(['index']);
    }
    public function index()
    {
        $data['title'] = "View Roles";
        $roles = Role::all();

        return view('roles.index', compact('roles', 'data'));
    }

    public function create()
    {
        // ✅ Group permissions
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('_', $permission->name)[0];
        });
    
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role created');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        // ✅ Group permissions
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('_', $permission->name)[0];
        });

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated');
    }
}