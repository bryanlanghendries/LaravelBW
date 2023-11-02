@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FAQ - {{ $category }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($faqitems as $faqitem)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $faqitem->question }}</h3>
                                    <p class="card-text">{{ $faqitem->answer }}</p>
                                    <p>{{ $faqitem->user->name }}</p>

                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <a href="{{ route('faqitem.edit', $faqitem) }}" class="btn btn-primary">Edit</a>
                                    @endif

                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <form method="POST" action="{{ route('faqitem.destroy', $faqitem) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
