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
                            @if ($user->avatar)
                                <img src="{{ asset("storage/$user->avatar") }}" alt="{{ $user->name }}"
                                    class="img-thumbnail" style="width: 150px">
                            @else
                                <img src="{{ asset('user_avatar.png') }}" alt="{{ $user->name }}" class="img-thumbnail"
                                    style="width: 150px">
                            @endif
                            <h2>
                                @if ($user->is_admin)
                                    <i class="fas fa-crown text-warning" title="Admin"></i>
                                @endif
                                {{ $user->name }}
                            </h2>

                            <p>{{ $user->biography }}</p>
                            @if ($user->birthday)
                                <p>Born on {{ $user->birthday }}</p>
                            @endif

                            @if (Auth::check() && Auth::user()->id === $user->id)
                                <a href="{{ route('profile.edit', $user->name) }}" class="btn btn-primary">Edit Profile</a>
                            @endif
                            @if (Auth::check() && Auth::user()->is_admin && !$user->is_admin)
                                <form method="POST" action="{{ route('profile.promote', $user->name) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Promote</button>
                                </form>
                            @endif
                        </div>


                        <div class="my-4">
                            <h2>Yapps</h2>
                            <ul class="list-group">
                                @foreach ($user->posts as $post)
                                    <li class="list-group-item">
                                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="my-4">
                            <h2>Likes</h2>
                            <ul class="list-group">
                                @foreach ($user->likes as $like)
                                    <li class="list-group-item">
                                        <a href="{{ route('posts.show', $like->post->id) }}">{{ $like->post->title }}</a>
                                        <p class="ml-2 d-inline">by</p>
                                        <a href="{{ route('profile', $like->post->user->name) }}"
                                            class="ml-2">{{ $like->post->user->name }}</a>
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
