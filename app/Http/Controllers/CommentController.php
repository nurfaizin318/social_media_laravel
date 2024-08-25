<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends ApiController
{
    // Menampilkan daftar semua komentar
    public function index(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        $comments = Comments::where('post_id', $id)->get();

        foreach($comments as $comment){
            $comment['editable'] = $comment['user_id'] == $validated['user_id'];
        }

        return response()->json($comments);
    }

    // Menampilkan komentar berdasarkan ID
    public function show($id)
    {
        $comment = Comments::with('user', 'post')->findOrFail($id);

        return response()->json($comment);
    }

    // Menyimpan komentar baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Comments::create($validatedData);

        return $this->successResponse('', 'Success update comment', 200);
    }

    public function update(Request $request)
    {
      

        $validated = $request->validate([
            'id' => 'required',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comments::findOrFail($validated['id']);

        $comment->update($validated);

        return $this->successResponse("","Success update comment", 200);
    }

    // Menghapus komentar berdasarkan ID
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}