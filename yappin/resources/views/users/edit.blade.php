@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="text-center mb-4">
                            @if ($user->avatar)
                            <img src="{{ asset("storage/avatars/$user->avatar") }}" alt="{{ $user->name }}" class="img-thumbnail" style="width: 150px">
                        @else
                            <img src="{{ asset('user_avatar.png') }}" alt="{{ $user->name }}" class="img-thumbnail" style="width: 150px">
                        @endif
                            <label for="avatar" class="d-block">Choose an Avatar:</label>
                            <input type="file" name="avatar" id="avatar" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="biography">Biography:</label>
                            <textarea name="biography" id="biography" rows="3" class="form-control">{{ $user->biography }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" name="birthday" id="birthday" value="{{ $user->birthday }}" class="form-control">
                        </div>

                        <button style="margin-top:8px;" type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
