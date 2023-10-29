@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Yappin News</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                        @endif


                        @auth
                            <form method="POST" action="{{ route('posts.store') }}" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex">
                                    <div class="w-100">
                                        <input type="text" name="title" class="form-control mb-2" placeholder="Yapp Title">
                                        <input type="text" name="content" class="form-control mb-2"
                                            placeholder="What is Yappin?!">
                                        <input type="file" name="cover" id="cover" class="form-control-file">
                                        <button type="submit" class="btn btn-primary ml-auto">Yapp</button>
                                    </div>
                                </div>
                            </form>
                        @endauth

                        @foreach ($posts as $post)
                            <x-card :post="$post"/>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
