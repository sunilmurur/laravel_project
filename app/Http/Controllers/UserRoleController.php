<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
       public function __construct()
    {
        $this->middleware('permission:permission_create')->only(['create','store']);
        $this->middleware('permission:permission_edit')->only(['edit','update']);
        $this->middleware('permission:permission_delete')->only(['destroy']);
        $this->middleware('permission:permission_view')->only(['index']);
        $this->middleware('permission:permission_changepassword')->only(['updatePassword']);
    }
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('users.roles', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Remove old roles and assign new role
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role updated successfully');
    }
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()
            ->with('success', 'Password updated successfully');
    }
}