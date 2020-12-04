@extends('layouts.app')

@section('content')
    <div class="auth-form-container">
        @if(session('error'))
            <div class="error">
                {{session('error')}}
            </div>
        @endif
        <form action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name ..." data-focus="true" value="{{ old("name") ??   auth()->user()->name }}">
            @error('name')
            <div class="error">
                {{$message}}
            </div>
            @enderror
            <label for="username">Username :</label>
            <input type="text" id="username" name="username" placeholder="Enter Your Username ..." data-focus="true" value="{{ old("username") ?? auth()->user()->username }}">
            @error('username')
            <div class="error">
                {{$message}}
            </div>
            @enderror
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Leave This Field Empty If You Do Not Wish To Update It" data-focus="true">
            @error('password')
            <div class="error">
                {{$message}}
            </div>
            @enderror
            <label for="password_confirmation">Confirm Password :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Leave This Field Empty If You Do Not Wish To Update It" data-focus="true">

            <label for="image">Profile Image :</label>
            <input type="file" id="image" name="image" placeholder="Enter An Image" data-focus="true">
            @error('image')
            <div class="error">
                {{$message}}
            </div>
            @enderror

            <input type="submit" value="Edit">
        </form>
    </div>
@endsection
