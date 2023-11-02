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
                        @if (Auth::check() && Auth::user()->is_admin)
                            <form method="POST" action="{{ route('faq.store') }}" class="mb-4"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <input type="text" name="question" class="form-control mb-2"
                                            placeholder="Question">
                                        <textarea class="form-control" name="answer" placeholder="Answer"></textarea>

                                        <select name="category" class="form-control mb-2">
                                            <option value="">Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        <button type="submit" style="margin-top: 4px;"
                                            class="btn btn-primary ml-auto">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <h2>Filter by Category:</h2>
                        @if (Auth::check() && Auth::user()->is_admin)
                            <form method="POST" action="{{ route('category.store') }}" class="mb-4">
                                @csrf
                                <label>Add new category</label>
                                <input type="text" name="category">
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        @endif
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('faq.category', $category->name) }}">{{ $category->name }}</a>
                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <form method="POST" action='{{ route('category.destroy', $category) }}'
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
