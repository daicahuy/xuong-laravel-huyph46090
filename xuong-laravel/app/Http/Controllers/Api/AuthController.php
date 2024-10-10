<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login ()
    {
        // mat khau sai: status code: 400
    }

    public function register (Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create($data);

        $token = $user->createToken(env('SANCTUM_NAME'))->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
    
    public function logout (Request $request)
    {
        // // Dang xuat tat ca cac thiet bi
        // $request->user()->tokens()->delete();

        $request->user()->currentAccessToken()->delete();

        return response()->json([], 204);
    }
}
