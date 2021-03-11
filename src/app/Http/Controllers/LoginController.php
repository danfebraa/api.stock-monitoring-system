<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index(Request $request)
    {
        $user= User::where('email', $request->Email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->Password, $user->password)) {
            return response([
                'Errors' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'Email' => $user->email,
            'Name' => $user->name,
            'Token' => $token
        ];

        return response($response, 201);
    }
}
