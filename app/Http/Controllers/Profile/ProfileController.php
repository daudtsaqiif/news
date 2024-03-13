<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
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
        $request->validate($request,[
            'current_password' => 'required',
            'password' => 'required',
            'confirmation_password' => 'required'
        ]);

        //check current password status
        $currentPasswordStatus = Hash::check(
            $request->current_password, auth()->user()->password,
        );

        if($currentPasswordStatus){
            if($request->password == $request->confirmation_password){
                //update password
                //get user login by id
                $user = auth()->user();

                //update password
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'password has ben update');
            } else{
                return redirect()->back()->with('error', 'password does not mach');
            }
        }else{
            return redirect()->back()->with('error', 'Current password is worng');
        }

    }
}
