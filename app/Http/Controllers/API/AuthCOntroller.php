<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ],'Authentication Failed', 500);
            };

            //cek jika password tidak sesuai
            $user = User::where('email', $credentials['email'])->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('Invalid Credentials');
            };

            //jika berhasil cek password maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated', 200);

        }catch (Exception $error){
            return ResponseFormatter::error([
                'message' => 'Unauthorized',
                'error' =>$error
            ],'Authentication Failed', 500);
        }
    }
    
    public function register(Request $request){
        try {
            //validate
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confrim_password' => 'required|string|min:6'
            ]);

            //cek kondisi password dan confirm password
            if($request->password != $request->confrim_password){
                return ResponseFormatter::error([
                    'massage' => 'Password not match',
                ], 'Authentication Failed', 401);
            }

            //create akun
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            //get data akun

            $user = User::where('email', $request->email)->first();

            //create token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            //response
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated', 200);

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went worng',
                'error' =>$error
            ], 'Authentication Failed', 500);
        }
    }
    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success([
            $token, 'Token Revoked'
        ], 'Token Revoked', 200);
    }
    public function allUsers(){
        $user = User::where('role', 'user')->get();
        return ResponseFormatter::success(
            $user, 'Data user berhasil diambil'
        );
    }
    public function updatePassword(Request $request){
        try {
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required|string|min:6',
                'confirm_password'=> 'required|string|min:6'
            ]);

            //get data user
            $user = Auth::user();

            //cek pw
            if (!Hash::check($request->old_password, $user->password)) {
                return ResponseFormatter::error([
                    'massage' => 'Password lama tidak sesuai',
                ],'Authentication Failed', 401);
            }

            if ($request->new_password != $request->confirm_password) {
                return ResponseFormatter::error([
                    'massage' => 'Password baru tidak sama',
                ],'Authentication Failed', 401);
            }

            //update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return ResponseFormatter::success([
                'massage' => 'password berhasil di update'
            ], 'Authenticated', 200);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'password kurang dari 6',
                'error' =>$error
            ], 'Authentication Failed', 500);
        }
    }
    public function storeProfile(Request $request){
        try {
            //validate

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
