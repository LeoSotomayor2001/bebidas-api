<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $data= $request->validated();
        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),

        ]);

        $token=$user->createToken('token')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ]);

    }
    public function login(LoginRequest $request){

        $data= $request->validated();
        if(!Auth::attempt($data)){
            return response([
                'errors' => ['Credenciales incorrectas']
            ],422);
        }
        $user=Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];


    }
    public function logout(Request $request)
    {
        //borrando el token
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return [
            'user' => null
        ];
        
    }
}
