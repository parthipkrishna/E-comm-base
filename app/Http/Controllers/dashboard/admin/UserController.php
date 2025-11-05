<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->roles === 'Super Admin') {
            $roles = $roles = [ 'Admin', 'Staff']; 
        } elseif ($user->roles === 'Admin') {
            $roles = ['Staff']; 
        } else {
            $roles = [];
        }
        $users = User::whereIn('roles', ['Super Admin', 'Admin','Staff'])
        ->where('id', '!=', $user->id)
        ->get();
        $user_main = $users->map(function ($user) {
            return [
                'user_id'       => $user->id,
                'name'          => $user->name,
                'user_role'     => $user->roles ?? 'N/A',
                'phone_number'  => $user->phone,
                'email'         => $user->email,
                'profile_image' => $user->profile_image,
                'status'        => $user->status,
            ];
        });


        return view('dashboard.user.index', compact('user_main','roles'));
    }
    public function customers()
    {   
        
        $users = User::where('roles', 'Customer')->get(); 
        $user_main = $users->map(function ($user) {
            return [
                'user_id'       => $user->id,
                'name'          => $user->name,
                'user_role'     => $user->roles ?? 'N/A',
                'phone_number'  => $user->phone,
                'email'         => $user->email,
                'profile_image' => $user->profile_image,
                'status'        => $user->status,
            ];
        });


        return view('dashboard.customers.index', compact('user_main')); 
    }

    public function role()
    {
        return view('dashboard.user.roles');
    }

    public function create()
    {
        // Get the logged-in user
        $user = auth()->user();
        if ($user->roles === 'Super Admin') {
            $roles = $roles = [ 'Admin', 'Staff']; 
        } elseif ($user->roles === 'Admin') {
            $roles = ['Staff']; 
        } else {
            $roles = []; 
        }

        return view('dashboard.user.add', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6',
            'phone' => 'required|unique:users,phone|min:10|max:15',
            'roles'    => 'required|string',
            'profile_image'=> 'nullable|image|mimes:jpg,jpeg,png,webp,svg,gif|max:2048',
        ]);

        try {
            $imagePath = $request->file('profile_image') 
                ? $request->file('profile_image')->store('uploads/images/Users', 'public') 
                : null;

            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'phone'  => $request->phone,
                'roles'     => $request->roles,
                'profile_image' => $imagePath,
                'status'        => $request->boolean('status'),
            ]);

            return redirect()->route('users.show')->with('message', 'User added successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = User::getRoleOptions();
        return view('dashboard.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $user->profile_image = $request->file('profile_image')->store('uploads/images/Users', 'public');
            }
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->roles = $request->roles ?? $user->roles;
            $user->phone = $request->phone ?? $user->phone;
            $user->status = $request->has('status') ? (int)$request->status : $user->status;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect()->back()->with('message', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update user.'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully.');
    }
    public function toggleStatus(Request $request)
    {

        $user = User::where('id', $request->user_id)->first();
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }
}