<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendships;
use Illuminate\Support\Facades\Validator;


class FriendShipController extends ApiController
{
    /**
     * Menampilkan daftar pertemanan.
     */
    public function index()
    {
        // Mengambil semua data pertemanan
        $friendships = Friendships::with(['user1', 'user2'])->get();

        return $this->successResponse($friendships, 'User created successfully', 201);
    }

    public function requestFriendship(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id1' => 'required',
            'user_id2' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->toJson(), 400);
        }
        // Membuat entri pertemanan baru
        Friendships::create($request->all());

        // Mengirimkan respons sukses
        return response()->json([
            'message' => "The friend request has been sent to user with '].",
            'data' => ""
        ], 201);
    }


    public function showRequestFrindship(Request $request)
    {
        // Mengambil data pertemanan berdasarkan ID
        $friendship = Friendships::where('user_id2','=', $request->input("id"))
        ->where('status','=',0)
        ->get();

        if (!$friendship) {
            return response()->json(['message' => 'Friendship not found'], 404);
        }

        return response()->json($friendship);
    }

    public function showFriendList(Request $request)
    {
        $validator = $request->validate([
            'user_id' => 'required',
         ]);

        $friendship = Friendships::where('user_id2','=',$validator['user_id'])
        ->where('status','=',1)
        ->get();

        if (!$friendship) {
            return response()->json(['message' => 'Friendship not found'], 404);
        }

        return response()->json($friendship);
    }

    /**
     * Mengupdate status pertemanan.
     */
    public function acceptFriendship(Request $request)
    {
        // Validasi input
        $validator = $request->validate([
            'id' => 'required',
            'user_id' => 'required',
         ]);

      

        // Mengambil data pertemanan berdasarkan ID
        $friendship = Friendships::where('user_id2','=',$validator['user_id'])
        ->where('friendship_id','=',$validator['id'])->first();

        if (!$friendship) {
            return $this->errorResponse("friendship request not found", 400);
        }

        // Mengupdate status pertemanan
        $friendship->status = 1;
        $friendship->save();

        return $this->successResponse("success add friend","",200);
    }

    /**
     * Menghapus pertemanan berdasarkan ID.
     */
    public function destroy($id)
    {
        // Mengambil data pertemanan berdasarkan ID
        $friendship = Friendships::find($id);

        if (!$friendship) {
            return response()->json(['message' => 'Friendship not found'], 404);
        }

        // Menghapus data pertemanan
        $friendship->delete();

        return response()->json(['message' => 'Friendship deleted successfully']);
    }
}
