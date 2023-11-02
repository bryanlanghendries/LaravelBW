@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FAQ</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @endif

                       
                        <form method="POST" action="{{ route('faq.store') }}" class="mb-4" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="d-flex">
                                <div class="w-100">
                                    <input type="text" name="question" class="form-control mb-2" placeholder="Question">
                                    <textarea class="form-control" name="answer" placeholder="Answer"></textarea>


                                    <select name="category" class="form-control mb-2">
                                        <option value="">Select or create a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

        
                                    <input type="text" name="new_category" class="form-control mb-2"
                                        placeholder="New Category">

                                    <button type="submit" style="margin-top:4px;"
                                        class="btn btn-primary ml-auto">Submit</button>
                                </div>
                            </div>
                        </form>

                        @foreach ($faqitems as $faqitem)
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ $faqitem->question }}</h1>
                                    <p>{{ $faqitem->answer }}</p>
                                    <small>{{ $faqitem->category->name }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
