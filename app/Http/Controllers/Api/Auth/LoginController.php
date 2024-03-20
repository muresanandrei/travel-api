<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);
        // Convert email to lowercase
        $credentials['email'] = strtolower($credentials['email']);

        try {
            // attempt to verify the credentials and create a token for the user
            if (Auth::attempt($credentials)) {
                $cookie = cookie('at', auth()->user()->createToken($request->device_type ?? 'web')->plainTextToken, 5440, '/', false, true, false, false, null);

                return response()->json([], 200)->withCookie($cookie);
            } else {
                return response()->json(['success' => false, 'message' => 'Can\'t find an account with these credentials.'], 401);
            }
        } catch (AuthenticationException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'message' => 'Login error try again!'], 500);
        }
    }
}
