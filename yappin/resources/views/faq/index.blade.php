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
                            <form method="POST" action="" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex">
                                    <div class="w-100">
                                        <input type="text" name="question" class="form-control mb-2" placeholder="Question">
                                        <textarea class="form-control" name="answer" placeholder="Answer"></textarea>
                                        <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @foreach ($faqitems as $faqitem)



                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
