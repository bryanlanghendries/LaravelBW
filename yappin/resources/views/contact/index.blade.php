@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                aria-label="First Name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                aria-label="Last Name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="question" placeholder="Your Question"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
