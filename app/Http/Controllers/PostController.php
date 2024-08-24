<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            "user_id" => "required"
        ]);

        $post = Posts::where("user_id", $validated["user_id"])->get();
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return $this->successResponse($post, "success get posts", 200);
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            "user_id" => "required|string"
        ]);

        $post = Posts::find($validated["user_id"]);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    public function store(Request $request)
    {
       $validated =  $request->validate([
            'user_id' => 'required',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        $imagePath = 'images/' . $imageName;
        

        $post = new Posts();
        $post -> user_id = $validated["user_id"];
        $post -> content = $validated["content"];
        $post -> media_url = $imagePath;
        $post -> save();


        return $this->successResponse("","success add post",201);
    }

    public function update(Request $request)
    {
       

        $validator = $request->validate([
            'user_id' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Posts::where("post_id","=", $validator["uder_id"])
                ->where("user_id", "=", $validator["user_id"])
                ->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            "user_id" => "required",
            "post_id" => "required"
        ]);


        $post = Posts::where("post_id", $validated["post_id"])
                ->where("user_id", $validated["user_id"])->first();


        if (!$post) {
            return $this->errorResponse("post not found", 400);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
