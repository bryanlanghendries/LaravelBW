@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <img src="{{ asset('user_avatar.png') }}" alt="{{ $user->name }}" class="img-thumbnail mb-3" style="width: 150px;">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->biography }}</p>

                        @if (Auth::check() && Auth::user()->id === $user->id)
                            <a href="" class="btn btn-primary">Edit Profile</a>
                        @endif

                        <h2> Posts </h2>

                        @foreach($user->posts as $post)
                         <a href="{{ route('posts.show', $post->id)}}"> {{ $post->title }} </a> <br>
                        @endforeach

                        <h2> Likes </h2>

                        @foreach($user->likes as $like)
                         <a href="{{ route('posts.show', $like->post->id)}}"> {{ $like->post->title }} </a> <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
