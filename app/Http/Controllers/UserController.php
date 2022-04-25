<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            return response()->json(
                [
                    "status" => "ok",
                    "token" => $user->createToken($user->id)->plainTextToken
                ],400
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
