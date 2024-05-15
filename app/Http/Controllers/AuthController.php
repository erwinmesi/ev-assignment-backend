<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authenticate a user.
     */
    public function login(LoginRequest $request)
    {
        // Find the user by email
        $user = User::where('email', $request->email)->firstOrFail();

        // Check if the password from the request matches the password in the database
        if (!Hash::check($request->password, $user->password)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        // Create a token for the user
        $access_token = $user->createToken('auth_token')->plainTextToken;

        return response(compact('access_token'));
    }
}
