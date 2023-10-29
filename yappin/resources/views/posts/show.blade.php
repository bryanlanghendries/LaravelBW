@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <x-card :post="$post" />

            <div class="mt-3">

                @auth
                    <div class="mb-3">
                        <form method="POST" action="{{ route('comment', $post->id) }}">
                            @csrf
                            <input type="text" name="content" class="form-control" placeholder="Add a comment">
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </form>
                    </div>
                @endauth

                @foreach ($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endsection
