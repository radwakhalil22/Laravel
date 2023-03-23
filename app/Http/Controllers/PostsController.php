<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $allPosts = Post::withTrashed()->paginate(5);
        return view('posts.index', ['posts' => $allPosts ]);
    }

    public function show($id)
    {
        // dd($id);
        $post = Post::where('id', $id)->first();
        return view('posts.show', ['post'=> $post]);
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

        // $post = new Post();


        // dd(request()->all());

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'image' => $image,
        ]);
        //return redirect()->route('posts.index');
        return to_route('posts.index');
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('posts.edit', ['post' => $post]);
    }

    public function update($id, StorePostRequest $request){
        $post = Post::find($id);
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,

        ]);
        return redirect()->route('posts.index');
    }

    public function delete($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }

    public function restore($id){
    $post = Post::withTrashed()->find($id);
    $post->restore();
    return redirect()->route('posts.index');
}

    public function deleteOldPost(){
        dispatch(new PruneOldPostsJob());
        return redirect()->back()->with('message', "Old posts deleted successfully");
    }


}
