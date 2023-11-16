@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif

                <h2>All Messages</h2>

                @foreach ($messages->sortBy('created_at') as $message)
                    <div class="card mb-3">
                        <div class="card-body">
                            <strong>Name:</strong> {{ $message->first_name }} {{ $message->last_name }}<br>
                            <strong>Email:</strong> {{ $message->email }}<br>
                            <strong>Question:</strong> {{ $message->question }}<br>
                            <strong>Date:</strong> {{ $message->created_at->format('F j, Y H:i:s') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
