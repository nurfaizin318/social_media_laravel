<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:50|unique:users',
            'Email' => 'required|string|email|max:100|unique:users',
            'Password' => 'required|string|min:6',
            'Name' => 'required|string|max:100',
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'Username' => 'string|max:50|unique:users,Username,' . $id,
            'Email' => 'string|email|max:100|unique:users,Email,' . $id,
            'Password' => 'string|min:6',
            'Name' => 'string|max:100',
        ]);

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}