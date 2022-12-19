@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Manage Films</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('films.create') }}">Add Film</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <br>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Release Year</th>
            <th>Created At</th>
            <th>Categories</th>
            <th>Action</th>
        </tr>
        @foreach ($films as $film)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $film->name }}</td>
                <td>{{ $film->year_of_release }}</td>
                <td>{{ date('Y-m-d', strtotime($film->created_at)) }}</td>
                <td>
                   @foreach($film->categories as $category)
                        <li>{{ $category->name }}</li>
                  @endforeach
                </td>
                <td>
                    <form action="{{ route('films.destroy', $film->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('films.show', $film->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('films.edit', $film->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
