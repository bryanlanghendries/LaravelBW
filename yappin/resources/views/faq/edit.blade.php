@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit FAQ Item</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('faqitem.update', $faqitem) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" name="question" id="question" class="form-control"
                                    value="{{ $faqitem->question }}" required>
                            </div>

                            <div class="form-group">
                                <label for="answer">Answer</label>
                                <textarea name="answer" id="answer" class="form-control" rows="4" required>{{ $faqitem->answer }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update FAQ Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
