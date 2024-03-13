<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
