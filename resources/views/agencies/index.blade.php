@extends('cpanel')

@section('title', 'Agencies')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0"> Agencies</h5>
            <br>
            <a class="btn btn-info btn-block" href="{{ route('agencies.create') }}">Add New Agency</a>
            <br>
        </div>
        <table class="table table-striped" id="data-table-agencies">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Orders Count</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
