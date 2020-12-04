<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Post $post){
        return view('post.show',['post' => $post]);
    }
    public function index(){

        $following = Profile::where('follower',auth()->user()->id)->get();
        $following = json_decode(json_encode($following),true);
        $following_id = array_map(function($record){
            return $record['following'];
        },$following);
        $following_id[] = auth()->user()->id;

        $posts = Post::whereIn('user_id',$following_id)->with('user')->latest()->get();
        return view('welcome',['posts' => $posts]);
    }
    public function create(){
        return view('post');
    }
    public function store(Request $request){
        $this->validate($request,[
            "caption" => "required|max:255",
            "image"   => "required|image"
        ]);

        $path = Storage::put("public/posts",$request->file('image'));
        $image = Image::make(public_path('/storage/'.substr($path,7)))->fit(1200,1200);
        $image->save();

        $post = new Post;
            $post->user_id = auth()->user()->id;
            $post->caption = $request->get('caption');
            $post->image = $path;
        $post->save();

        return redirect()->route("users",auth()->user()->username);
    }
}
