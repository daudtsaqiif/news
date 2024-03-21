<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCOntroller extends Controller
{
    //
    public function login(Request $request){
        try{
            //validate
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            //cek credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])){
                return ResponseFormatter::error([]);
            };
        }catch (Exception $error){

        }
    }
}
