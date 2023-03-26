<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $allPosts = Post::withTrashed()->with('user')->paginate(5);
        return PostResource::collection($allPosts);
    }

    public function show($id){
        // dd($id);
        $post = Post::where('id', $id)->first();
        return new PostResource($post);
        // return[
        //     'title' => $post->title,
        //     'id' => $post->id,
        //     'description' => $post->description,
        // ];
        // return $post;
    }

    public function store(StorePostRequest $request)
    {
        $title = $request->title;
        $description = $request->description;
        $postCreator = $request->user_id;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
        }

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            // 'image' => $image,
        ]);
        // return[
        //     'title' => $post->title,
        //     'id' => $post->id,
        //     'description' => $post->description,
        // ];
        return new PostResource($post);
    }
}


