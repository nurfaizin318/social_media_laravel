<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Posts::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|exists:users,UserID',
            'Content' => 'required|string',
            'MediaType' => 'nullable|string|max:20',
            'MediaURL' => 'nullable|string|max:255',
        ]);

        $post = Posts::create($request->all());
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Posts::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $request->validate([
            'UserID' => 'exists:users,UserID',
            'Content' => 'string',
            'MediaType' => 'nullable|string|max:20',
            'MediaURL' => 'nullable|string|max:255',
        ]);

        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Posts::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
