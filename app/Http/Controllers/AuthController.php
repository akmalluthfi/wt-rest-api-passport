<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($validator->validated())) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 400);
        }

        /**
         * get the authenticate user model
         * @var \App\Models\User
         */

        $user = Auth::user();

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('my-token')->accessToken
        ]);
    }

    public function logout(Request $request)
    {
        /**
         * get the authenticate user model
         * @var \App\Models\User
         */
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return (new UserResource($user))->response()->setStatusCode(201);
    }
}
