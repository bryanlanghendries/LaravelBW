@extends('layouts.app')

@section('content')
<div class="container"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card"> <div
    class="card-header">Yappin News</div> <div class="card-body"> @if (session('status')) <div class="alert
    alert-success" role="alert"> {{ session('status') }} </div>
@endif


@auth
    <form method="POST" action="{{ route('post.store') }}" class="mb-4">
        @csrf
        <div class="d-flex">
            <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
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
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                    <div> 
                        <h5 class="mb-1">{{ $post->user->name }}</h5> 
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        @if ($post->is_edited)
                        <small class="text-muted"> *edited* </small>
                        @endif
                    </div>
                </div>
                <div>
                    @auth
                        @if ($post->user_id == Auth::user()->id)
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
            <h3>{{ $post->title }}</h3>
            <p class="card-text">{{ $post->content }}</p>
            @if ($post->cover_image)
                <img src="{{ $post->cover_image }}" alt="Post Image" class="img-fluid">
            @endif
        </div>
    </div> 
@endforeach

    </div> 
</div> 
</div>
            </div>
        </div>
@endsection