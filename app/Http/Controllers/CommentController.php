<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $post){
        $post = Post::findOrFail($post);

        $this->validate($request,[
            "comment" => 'required|string|max:200'
        ]);

        $comment = new Comment;
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->input('comment');
        $comment->save();
        return back();
    }
}
