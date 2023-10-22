@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="mb-4">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex">
                                <img src="user_avatar.png" alt="User Avatar" width="64" height="64" class="rounded-circle mr-3">
                                <div class="w-100">
                                    <input type="text" name="title" class="form-control mb-2" placeholder="Yapp Title" value="{{ $post->title }}">
                                    <input type="text" name="content" class="form-control mb-2" placeholder="What is Yappin?!" value="{{ $post->content }}">
                                    <button type="submit" class="btn btn-primary ml-auto">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
