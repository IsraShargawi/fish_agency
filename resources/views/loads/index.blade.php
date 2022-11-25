
@extends('cpanel')

@section('title', 'Load')

@section('content')

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Loads</h5>

                    <br>
                    <a class="btn btn-info btn-block" href="{{ route('loads.create') }}">Add New Load</a>
                    <br>
               
                </div>
                <table class="table table-striped" id="data-table-loads">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Boat Name</th>
                          <th scope="col">Create Date</th>
                          <th scope="col">Expired Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                </table>
            </div>
                          
@endsection
