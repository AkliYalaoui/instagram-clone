<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($username){
        $users = User::where('username',$username)->get();
        if(count($users) <= 0){
            abort(404);
        }

        $user = $users[0];
        $tmp = Profile::where(['follower' => auth()->user()->id,'following' => $user->id])->count();

        $following = Cache::remember('following.count'.$user->id,now()->addSeconds(30),fn() =>  Profile::where('follower',$user->id)->count());
        $followers = Cache::remember('followers.count'.$user->id,now()->addSeconds(30),fn() =>   Profile::where('following',$user->id)->count());
        $post_count = Cache::remember('posts.count.'.$user->id,now()->addSeconds(30),fn()=> $user->posts->count());
        return view('users',[
            "user"          => $user,
            "can_follow"    =>  $tmp > 0 ? false:true,
            "following"     => $following,
            "followers"     => $followers,
            "post_count"    =>  $post_count,
            "posts"         => $user->posts
        ]);
    }
    public function edit(){
        return view('edit');
    }
    public function update(Request $request){

        $path = 'public/profiles/index.png';
        $pwd  = auth()->user()->password;

        if(request('image') && ( request('password') || request('password_confirmation') )){
            $this->validate($request,[
                "name" => 'required|min:6|max:100',
                'username' => 'required|min:6|max:100',
                'password' => 'required|confirmed|min:6|max:100',
                'image' => 'required|image'
            ]);

            $pwd = Hash::make(request('password'));
            $path = Storage::put("public/profiles",$request->file('image'));
            $image = Image::make(public_path('/storage/'.substr($path,7)))->fit(800,800);
            $image->save();

        }elseif (!request('image')  && ( request('password') || request('password_confirmation') ) ){
            $this->validate($request,[
                "name" => 'required|min:6|max:100',
                'username' => 'required|min:6|max:100',
                'password' => 'required|confirmed|min:6|max:100'
            ]);
            $pwd = Hash::make(request('password'));
        }elseif ( request('image') && !( request('password') || request('password_confirmation') )){
            $this->validate($request,[
                "name" => 'required|min:6|max:100',
                'username' => 'required|min:6|max:100',
                'image' => 'required|image'
            ]);
            $path = Storage::put("public/profiles",$request->file('image'));
            $image = Image::make(public_path('/storage/'.substr($path,7)))->fit(800,800);
            $image->save();
        }

        $user = User::where([
            [ 'username' ,'=', $request->input('username')],
            ['id','!=',auth()->user()->id]
        ])->get();

        if(count($user) > 0){
            return  back()->with('error','User Already Exists');
        }
        $user = User::find(auth()->user()->id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->image = $path;
        $user->password = $pwd;

        $user->update();
        return redirect()->route("users",$request->get('username'));
    }
}
