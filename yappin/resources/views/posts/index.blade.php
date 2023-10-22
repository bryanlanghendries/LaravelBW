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
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex align-items-center">
                    <a href="{{ route('profile', $post->user->name) }}" style="text-decoration: none; color: inherit;">
                        <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                        <h5 class="mb-1" onclick="window.location='{{ route('profile', $post->user_id) }}';" style="cursor: pointer;">
                            {{ $post->user->name }}
                        </h5>
                    </a>
                </div>
                <div>
                    <div>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        @if ($post->is_edited)
                            <small class="font-weight-bold"> *edited* </small>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <h3>{{ $post->title }}</h3>
            <p class="card-text">{{ $post->content }}</p>
            @if ($post->cover_image)
                <img src="{{ $post->cover_image }}" alt="Post Image" class="img-fluid mb-2">
            @endif
            <br>
            <div class="d-flex justify-content-between">
                <div>
                    {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                    <a href="{{ route('like', $post->id) }}" class="text-primary mr-2">Like</a>
                </div>
                <div>
                    <span class="mr-3">0 comments</span>
                    <a href="#" class="text-primary">Comment</a>
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