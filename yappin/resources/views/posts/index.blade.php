@extends('layouts.app')

@section('content')
<div class="container"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card"> <div
    class="card-header">Yappin News</div> <div class="card-body"> @if (session('status')) <div class="alert
    alert-success" role="alert"> {{ session('status') }} </div>
@endif


@auth
    <form method="POST" action="{{ route('posts.store') }}" class="mb-4">
        @csrf
        <div class="d-flex">
            <div class="w-100">
                <input type="text" name="title" class="form-control mb-2" placeholder="Yapp Title">
                <input type="text" name="content" class="form-control mb-2" placeholder="What is Yappin?!">
                <button type="submit" class="btn btn-primary ml-auto">Yapp</button>
            </div>
        </div>
    </form>
@endauth







@foreach($posts as $post)
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex align-items-center">
                    <a href="{{ route('profile', $post->user->name) }}" style="text-decoration: none; color: inherit;">
                        @if ($post->user->avatar)
                        <img src="{{ asset('storage/avatars/'.$post->user->avatar) }}" alt="{{ $post->user->name }}" class="img-thumbnail" style="width: 150px">
                    @else
                        <img src="{{ asset('user_avatar.png') }}" alt="{{ $post->user->name }}" class="img-thumbnail" style="width: 150px">
                    @endif
                        <strong class="mb-1" onclick="window.location='{{ route('profile', $post->user_id) }}';" style="font-size:24px; cursor: pointer;">
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
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
                </div>
            </div>
            <br>
            <h3> <a href="{{ route('posts.show', $post->id)}}"> {{ $post->title }} </a> </h3>
            <p class="card-text">{{ $post->content }}</p>
            @if ($post->cover_image)
                <img src="{{ $post->cover_image }}" alt="Post Image" class="img-fluid mb-2">
            @endif
            <br>
            <div class="d-flex justify-content-between">
                <div>
                    {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                    <a href="{{ route('like', $post->id) }}" class="text-primary mr-2">{{ 'like' }}</a>
                </div>
                <div>
                    <span class="mr-3">0 comments</span>
                    <a href="{{ route('posts.show', $post->id)}}" class="text-primary">Comment</a>
                </div>
            </div>
        </div>
    </div> 
@endforeach



    </div> 
</div> 
</div>
            </div>
        </div>
@endsection