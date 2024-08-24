<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->errorResponse($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request -> password;
        $user->save();

        return $this->successResponse($user, 'User created successfully', 201);
    }

    public function login(Request $request)
    {

   
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => $credentials], 401);
        }

        $user = User::where('email', $request -> email)->first();

        $responseData = [
            'user' => $user,
            'token' => $token,
        ];
        return $this->successResponse($responseData);
    }
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}  