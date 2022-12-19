@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Manage Films For All Users</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <br>
    <table class="table table-bordered table-striped" id="allFilmsTable" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Release Year</th>
                <th>Created At</th>
                <th>Categories</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
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
                    <td>{{ $film->user->name }}</td>
                    <td>
                        @if($film->user_id === auth()->id())
                            <a class="btn btn-primary" href="{{ route('films.edit', $film->id) }}">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
    </table>

    <div class="d-flex">
        {!! $films->links() !!}
    </div>
@endsection

@section('datatable-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#allFilmsTable').DataTable();
        });
    </script>
@endsection
