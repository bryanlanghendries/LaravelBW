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
                    </div>

                    <div class="my-4">
                        <h2>Yapps</h2>
                        <ul class="list-group">
                            @foreach($user->posts as $post)
                             <li class="list-group-item">
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                             </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="my-4">
                        <h2>Likes</h2>
                        <ul class="list-group">
                            @foreach($user->likes as $like)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', $like->post->id) }}">{{ $like->post->title }}</a>
                                    <p class="ml-2 d-inline">by</p>
                                    <a href="{{ route('profile', $user->name) }}" class="ml-2">{{ $user->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
