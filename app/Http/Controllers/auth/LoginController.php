<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'username' => 'required|min:6|max:100',
            'password' => 'required|min:6|max:100'
        ]);
        if(Auth::attempt($request->only(['username','password']))){
            return redirect('/');
        }
        return back()->with('error','Invalid Credentials');
    }

    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $path = 'public/profiles/index.png';
        $this->validate($request,[
           'name'  => 'required|min:6|max:100',
            'username' => 'required|min:6|max:100',
            'password' => 'required|confirmed|min:6|max:100'
        ]);
        $user = User::where('username',$request->get('username'))->get();
        if(count($user) > 0){
            return  back()->with('error','User Already Exists');
        }
        $user = new User;
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->image = $path;
        $user->save();
        Auth::attempt($request->only(['username','password']));
        return redirect('/');
    }
}
