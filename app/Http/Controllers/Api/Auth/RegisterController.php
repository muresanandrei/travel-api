<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(AuthRequest $request): JsonResponse
    {

        $credentials = $request->safe()->only(['name', 'roles', 'email', 'password']);

        //encrypt password
        $credentials['password'] = Hash::make($request['password']);

        $userModel = new User;

        $user = $userModel->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        // Assign roles to the user
        if ($request->has('roles')) {
            foreach ($credentials['roles'] as $roleId) {
                $user->roles()->attach($roleId);
            }
        }

        //create a cookie with the token
        $cookie = cookie('at', $user->createToken($request->device_type ?? 'web')->plainTextToken, 5440, '/', false, true, false, false, null);

        return response()->json(['success' => true], 201)->withCookie($cookie);
    }
}
