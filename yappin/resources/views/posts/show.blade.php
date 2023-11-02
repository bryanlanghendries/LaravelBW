@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                @endif

                <x-card :post="$post" />

                <div class="mt-3">

                    @auth

                        <form method="POST" action="{{ route('comment', $post->id) }}">
                            @csrf
                            <div class="mb-3 input-group">
                                <input type="text" name="content" class="form-control" placeholder="Add a comment">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Comment</button>
                                </div>
                            </div>
                        </form>

                    @endauth

                    @foreach ($post->comments as $comment)
                        <div class="card mb-2">
                            <div class="card-body">
                                <strong>{{ $comment->user->name }}</strong>
                                <p>{{ $comment->content }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                @if ($post->user->is_admin)
                                    <i class="fas fa-crown text-warning" title="Admin"></i>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endsection
