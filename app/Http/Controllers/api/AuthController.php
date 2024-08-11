<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function login(Request $request){
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['Mensaje' => 'Inicio Invalido'],404);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        // if ($request->email == "acevedo51198mac@gmail.com") {
        if ($request->email == "admin@gmail.com") {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }else{
            return response()->json([
                'Status' => 200,
                'Mensaje' => 'OK',
            ], 200);
        }
    }
}
