<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function register(Request $request){
        $validated=$request->validate(
            [
                'name'=>'required|string|max:255',
                'email'=>'required|email|unique:users,email,email',
                'password'=>'required|string||min:6|confirmed'
            ]
        );
        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
             'password'=>Hash::make($validated['password'])
        ]);
        $customerRole=Role::where('slug','customer')->first();
        $user->roles()->attach($customerRole->id);
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'User registered Successfully',
            'user'=>$user,
            'token'=>$token
        ],201);
    }

}
