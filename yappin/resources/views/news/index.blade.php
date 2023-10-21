@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Yappin News</div>
           

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::check())
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center mb-3">
                                <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                                <input type="text" name="post_content" class="form-control" placeholder="What is yappin?!">
                                <button type="submit" class="btn btn-primary ml-auto">Yapp</button>
                            </div>
                        </form>
                    @endif


                    @foreach($news as $n)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center space-x-4 mb-3">
                                    <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                                    <div class="px-2">
                                        <h5 class="mt-0 mb-1">{{ $n->user->name }}</h5>
                                        <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="card-text">{{ $n->content }}</p>
                                @if ($n->cover_image)
                                    <img src="{{ $n->cover_image }}" alt="News Image" class="img-fluid">
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
