@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FAQ</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                        @endif


                        @if(Auth::user() && Auth::user()->is_admin)
                            <form method="POST" action="{{ route('faq.store') }}" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex">
                                    <div class="w-100">
                                        <input type="text" name="question" class="form-control mb-2" placeholder="Question">
                                        <textarea class="form-control" name="answer" placeholder="Answer"></textarea>
                                        <button type="submit" style="margin-top:4px;" class="btn btn-primary ml-auto">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @foreach ($faqitems as $faqitem)

                        <h1>{{ $faqitem->question }}</h1>
                        <p> {{ $faqitem->answer }} </p>
                        <small> {{ $faqitem->category->name }} </small>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
