<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //User Index Page
    public function userIndex()
    {
        $allUser = User::select('id', 'name', 'email')
            ->get()->except(1);
        return view('backend.users.usersIndex', compact('allUser'));
    }


    //User Create Page
    public function userCreate()
    {
        $allRole = Role::select('id', 'name')->get()->except(1);
        return view('backend.users.userCreate', compact('allRole'));
    }


    //User Store

    public function userStore(Request $request)
    {
        $newUserData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'min:8',
        ]);
        $role = $request->role;

        if ($role == 1) {
            return back();
        } else {
            $newUser = User::create($newUserData);
            $newUser->assignRole($role);
        }

        return redirect()->route('admin.user.index');
    }

    //User Profile
    public function profile(Request $request)
    {
        // $currentUser = Auth::user()->id;
        // $profileData = User::whereId($currentUser)->firstOrFail();

        return view('backend.users.profile');
    }

    //Update Password
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("success", "Password changed successfully!");
    }
}
