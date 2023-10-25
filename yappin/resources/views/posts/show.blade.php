@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('profile', $post->user->name) }}"
                                            style="text-decoration: none; color: inherit;">
                                            @if ($post->user->avatar)
                                                <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}"
                                                    alt="{{ $post->user->name }}" class="img-thumbnail"
                                                    style="width: 150px">
                                            @else
                                                <img src="{{ asset('user_avatar.png') }}" alt="{{ $post->user->name }}"
                                                    class="img-thumbnail" style="width: 150px">
                                            @endif
                                            <strong class="mb-1"
                                                onclick="window.location='{{ route('profile', $post->user_id) }}';"
                                                style="font-size:24px; cursor: pointer;">
                                                {{ $post->user->name }}
                                            </strong>
                                        </a>
                                    </div>
                                    <div>
                                        <div>
                                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                            @if ($post->is_edited)
                                                <small class="font-weight-bold"> *edited* </small>
                                            @endif
                                        </div>

                                        <div>
                                            @auth
                                                @if ($post->user_id == Auth::user()->id)
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-primary mr-2">Edit</a>
                                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Yapp?');">Delete</button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>

                                        @auth
                                            @if (Auth::user()->is_admin && Auth::user()->id !== $post->user_id)
                                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to remove this Yapp?');">
                                                        Remove </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <br>
                                <h3> {{ $post->title }} </h3>
                                <p class="card-text">{{ $post->content }}</p>
                                @if ($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Post Image"
                                        class="img-fluid mb-2" style="max-width: 400px; max-height: 300px;">
                                @endif
                                <br>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                                        <a href="{{ route('like', $post->id) }}"
                                            class="text-primary mr-2">{{ 'like' }}</a>
                                    </div>
                                    <div>
                                        <span class="mr-3">0 comments</span>
                                        <a href="#" class="text-primary">Comment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endsection
