<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

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
        }catch (Exception $error){

        }
    }
}
