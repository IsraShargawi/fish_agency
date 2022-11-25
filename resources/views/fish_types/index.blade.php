@extends('cpanel')

@section('title', 'Fish Types')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Fish Types</h5>
            <br>
            <a class="btn btn-info btn-block" href="{{ route('fish_types.create') }}">{{ __('strings.create_label') }}</a>
            <br>
        </div>
        <table class="table table-striped" id="data-table-fish_types">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Fish In Stock</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection
