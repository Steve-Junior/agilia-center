@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View Film') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>Title:</h5> <h4> {{$film->name}}</h4><br>
                    <h5>Release Year:</h5> <h4> {{$film->year_of_release}}</h4><br/>
                    <h5>Categories: </h5>
                        <h4> @foreach($film->categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </h4>

                    <br>
                    <div>
                        <h4>Cover Art</h4>
                        <img src="{{ asset($film->cover_image_url) }}" alt="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
