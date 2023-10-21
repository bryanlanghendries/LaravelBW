@extends('layouts.app')

@section('content')
<div class="container"> <div class="row justify-content-center"> <div class="col-md-8"> <div class="card"> <div
    class="card-header">Yappin News</div> <div class="card-body"> @if (session('status')) <div class="alert
    alert-success" role="alert"> {{ session('status') }} </div>
@endif


@auth
    <form method="POST" action="{{ route('news.store') }}" class="mb-4">
        @csrf
        <div class="d-flex">
            <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
            <div class="w-100">
                <input type="text" name="title" class="form-control mb-2" placeholder="Yapp Title">
                <input type="text" name="content" class="form-control mb-2" placeholder="What's happening?">
                <button type="submit" class="btn btn-primary ml-auto">Yapp</button> <!-- Use ml-auto to push the button to the right -->
            </div>
        </div>
    </form>
@endauth







        @foreach($news as $n)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                    <div> <h5 class="mb-1">{{ $n->user->name }}</h5> <small class="text-muted">{{
                    $n->created_at->diffForHumans()
                    }}</small>
                    </div> </div> <h3>{{ $n->title }}</h3>
                    <p class="card-text">{{ $n->content }}</p>
                    @if ($n->cover_image)
                    <img src="{{ $n->cover_image }}" alt="News Image" class="img-fluid">
                    @endif
                </div>
                </div> @endforeach </div> </div> </div>
            </div>
        </div>
        @endsection