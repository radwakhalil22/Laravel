<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request, $post_id){
        $body = $request->body;
        $post = Post::find($post_id);
        $post->comments()->create(['body' => $body]);
        return redirect()->route('posts.show', $post_id);
    }

    public function deleteComment($post_id, $comment_id){
        $post = Post::find($post_id);
        $post->comments()->where('id', $comment_id)->delete();
        return redirect()->route('posts.show', $post_id);
    }

    // public function editComment($post_id, $comment_id){
    //     $post = Post::find($post_id);
    //     $comment = $post->comments()->where('id', $comment_id)->first();
    //     return view('comments.edit', compact('comment'));
    // }
}
