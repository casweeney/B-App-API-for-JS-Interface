<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request){
        $post = Post::create([
            "title" => $request->title,
            "body" => $request->content
        ]);

        return response()->json([
            "post" => $post
        ], 200);
    }

    public function fetchPosts(){
        $posts = Post::all();
        return $posts;
    }

    public function updatePost(Request $request, $id){
        $post = Post::where(['id' => $id])->first();

        if(!is_null($post)){
            $post->title = $request->title;
            $post->body = $request->content;

            $post->save();

            return response()->json([
                "post" => $post
            ], 200);
        }
    }

    public function deletePost($id){
        $post = Post::where(['id' => $id])->first();
        $post->delete();

        return response()->json([
            "msg" => "Post Deleted"
        ], 200);
    }
}
