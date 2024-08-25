<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PostController extends ApiController
{
    public function index($id)
    {

        $posts = Posts::where('user_id', $id)
        ->withCount('comments')
        ->withCount('likes')
        ->get();
        if (!$posts) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return $this->successResponse($posts, "success get posts", 200);
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

        return $this-> successResponse($post , "Success get Post", 200);
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

    public function update(Request $request, $id)
    {
       

        $validator = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

 
        $post = Posts::findOrFail($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if(File::exists($post->media_url)) {
            File::delete($post->media_url);
        }

        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        $imagePath = 'images/' . $imageName;

        $validatedData['image'] = $imagePath;

        $post->content = $validator['content'];
        $post->media_url = $imagePath;
        $post->save();

        return $this->successResponse("","success update post",200);
    }

    public function destroy($id)
    {

        $post = Posts::find($id);

        if(File::exists($post->media_url)) {
            File::delete($post->media_url);
        }


        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
