@extends('layouts.app')

@section('content')
    <div class="auth-form-container">
        @if(session('error'))
            <div class="error">
                {{session('error')}}
            </div>
        @endif
        <form action="{{ route('register') }}" method="post">
            @csrf
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name ..." value="{{ old('name','') }}" data-focus="true">
                @error('name')
                    <div class="error">
                        {{$message}}
                    </div>
                @enderror
            <label for="username">Username :</label>
            <input type="text" id="username" name="username" placeholder="Enter Your Username ..." value="{{ old('username','') }}" data-focus="true">
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
            <label for="password_confirmation">Confirm Password :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter Your password ..." data-focus="true">

            <input type="submit" value="Register">
        </form>
    </div>
@endsection
