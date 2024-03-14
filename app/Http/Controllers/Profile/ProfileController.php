<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        $title = 'Profile - index';
        return view('home.profile.index', compact('title'));
    }

    public function changePassword(){
        $title = 'Change - Password';

        return view('home.profile.change-password', compact('title'));
    }

    public function updatePassword(Request $request){
        //validate
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|min:6'
        ]);

        //check current password status
        $currentPasswordStatus = Hash::check(
            $request->current_password, auth()->user()->password
        );

        if($currentPasswordStatus){
            if($request->password == $request->confirmation_password){
                //update password
                //get user login by id
                $user = auth()->user();

                //update password
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'password has been update');
            } else{
                return redirect()->back()->with('error', 'password does not mach');
            }
        }else{
            return redirect()->back()->with('error', 'Current password is worng');
        }

    }

    public function allUser(){
        $title = 'All User';
        $user = User::all();

        return view('home.user.index', compact('title', 'user'));
    }
}
