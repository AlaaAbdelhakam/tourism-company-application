<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() 
    {
        $admins = Admin::latest()->paginate(10);

        return view('admins.index', compact('admins'));
    }
    public function create() 
    {        $teams = Team::get();

        return view('admins.create',compact('teams'));
    }
    public function destroy(Admin $admin) 
    {
        $admin->delete();

        return redirect()->route('admins.index')
            ->withSuccess(__('Admin deleted successfully.'));
    }

    public function edit(Admin $admin) 
    {   
        $teams = Team::get();

        return view('admins.edit', [
            'admin' => $admin,
            // 'userRole' => $user->roles->pluck('name')->toArray(),
            // 'roles' => Role::latest()->get()
        ],compact('teams'));
    }

    public function show(Admin $admin) 
    {
        
        return view('admins.show', [
            'admin' => $admin
        ]);
      
    }

    public function store(Admin $admin, Request $request) 
    {
        $admin=Admin::create(array_merge($request->only('name', 'email', 'username',['password' => Hash::make($request->input('password'))])));
        return redirect()->route('admins.index')
            ->withSuccess(__('Admin created successfully.'));
    }

    public function update(Admin $admin, Request $request) 
    {
        $admin->update($request->all());

        // $admin->syncRoles($request->get('role'));
        // $user->teams()->syncWithoutDetaching($request->team_id);
        return redirect()->route('admins.index')
            ->withSuccess(__('Admin updated successfully.'));
    }
}
