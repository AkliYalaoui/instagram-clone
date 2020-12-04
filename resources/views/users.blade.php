@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <div class="profile-user">
            <img src="{{asset('/storage/'.(substr($user->image,7)))}}" class="profile-img" alt="profile Image">
            <div class="profile-stats">
                <span>{{$user->username}}</span>
                @if($user->username == auth()->user()->username)
                    <a href="{{ route('users.edit') }}">Edit Profile</a>
                @else
                    @if($can_follow)
                        <form action="{{route('follow',$user->id)}}" method="post">
                            @csrf
                            <input type="submit" value="follow" class="follow-btn">
                        </form>
                    @else
                        <form action="{{route('unfollow',$user->id)}}" method="post">
                            @csrf
                            <input type="submit" value="unfollow" class="follow-btn">
                        </form>
                    @endif
                @endif


                <div class="numbers">
                    <span><strong>{{$post_count}}</strong> {{Str::plural('Post',$post_count)}}</span>
                    <span><strong>{{ $followers }}</strong> {{Str::plural('Follower',$followers)}}</span>
                    <span><strong>{{$following}}</strong> Following</span>
                </div>
                <h2>{{$user->name}}</h2>
            </div>
        </div>
        <hr>
        <div class="all-posts">
            <span>Posts</span>
            <div class="images-container">
                @forelse($posts as $post)
                    <a href="">
                        <img src="{{asset('/storage/'.(substr($post->image,7)))}}" alt="profile Image">
                    </a>
                @empty
                    You Have No Posts
                @endforelse
            </div>
        </div>
    </div>
@endsection
