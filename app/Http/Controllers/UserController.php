<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            return response()->json(
                [
                    "status" => "ok",
                    "token" => $user->createToken($user->id)->plainTextToken
                ],200
            );
        }else{
            return response()->json(
                [
                    "status" => "invalid email or password"
                ],403
            );
        }
    }
}
