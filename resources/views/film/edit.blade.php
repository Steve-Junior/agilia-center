@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Film') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('films.update', $film->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="form-control" value="{{$film->name}}">
                            @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="release-year">Release Date</label>
                            <input id="release-year" type="text" name="release_year" class="form-control" value="{{$film->year_of_release}}">
                            @if($errors->has('release_year'))
                                <div class="text-danger">{{ $errors->first('release_year') }}</div>
                            @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="category">Category
                                @if($errors->has('category_id'))
                                    <div class="text-danger float-sm-end">{{ $errors->first('category_id') }}</div>
                                @endif
                            </label>
                            <select multiple="multiple" id="category" name="category_id[]" class="form-control">
                                @foreach($film->categories as $category)
                                    <option selected value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach

                                @foreach($unselectedCategories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div>
                            <p>Cover Art Preview</p>
                            <img src="{{ asset($film->cover_image_url) }}" width="300px" height="auto" alt="1">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cover-art">Change Cover Art</label>
                            <input id="cover-art" type="file" accept="image/*"  name="photo" class="form-control">
                            @if($errors->has('photo'))
                                <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
