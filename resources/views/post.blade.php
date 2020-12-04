@extends('layouts.app')

@section('content')
    <div class="auth-form-container">
        <h1 class="post-title">Add New Post</h1>
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="caption">Caption :</label>
            <input type="text" id="caption" name="caption" placeholder="Enter A Caption" data-focus="true">
                @error('caption')
                    <div class="error">
                        {{$message}}
                    </div>
                @enderror

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" placeholder="Enter An Image" data-focus="true">
                @error('image')
                    <div class="error">
                        {{$message}}
                    </div>
                @enderror

            <input type="submit" value="Post">
        </form>
    </div>
@endsection
