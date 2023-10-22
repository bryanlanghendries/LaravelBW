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
                        <img src="user_avatar" alt="{{ $user->name }}" class="img-thumbnail mb-3" style="width: 150px;">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->biography }}</p>

                        @if (Auth::check() && Auth::user()->id === $user->id)
                            <a href="" class="btn btn-primary">Edit Profile</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
