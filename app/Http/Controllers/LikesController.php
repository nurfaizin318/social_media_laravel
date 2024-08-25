<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;


class LikesController extends ApiController
{
    // Menampilkan semua likes
    public function index()
    {
        $likes = Likes::with(['post', 'comment', 'user'])->get();
        return response()->json($likes);
    }

    // Menambahkan like baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'post_id' => 'required|',
            'user_id' => 'required|exists:users,id',
        ]);

        // Membuat like baru
        $like = Likes::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'time_stamp' => now(),
        ]);

        return $this->successResponse("","success add like",200);
    }

    // Menghapus like berdasarkan ID
    public function destroy($id)
    {
        $like = Likes::findOrFail($id);

        $like->delete();

        return $this->successResponse("","success  unlike",200);
    }

    // Menampilkan detail like berdasarkan ID
    public function show($id)
    {
        $like = Likes::with(['post', 'comment', 'user'])->findOrFail($id);

        return response()->json($like);
    }
}
