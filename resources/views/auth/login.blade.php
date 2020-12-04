@extends('layouts.app')

@section('content')
    <div class="auth-form-container">
        @if(session('error'))
            <div class="error">
                {{session('error')}}
            </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf

            <label for="username">Username :</label>
            <input type="text" id="username" name="username" placeholder="Enter Your Username ..." data-focus="true">
                @error('username')
                    <div class="error">
                        {{$message}}
                    </div>
                @enderror
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter Your password ..." data-focus="true">
                @error('password')
                    <div class="error">
                        {{$message}}
                    </div>
                @enderror

            <input type="submit" value="Login">
        </form>
    </div>
@endsection
