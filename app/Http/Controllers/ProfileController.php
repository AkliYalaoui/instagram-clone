<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id){
        User::findOrFail($id);

        $profile = new Profile;
        $profile->follower = auth()->user()->id;
        $profile->following = $id;
        $profile->save();
        return back();
    }
    public function destroy($id){
        User::findOrFail($id);
        $profile = Profile::where(['follower' => auth()->user()->id,'following' => $id ]);
        $profile->delete();
        return back();
    }
}
