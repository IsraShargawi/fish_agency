
@extends('cpanel')

@section('title', 'Boat')

@section('content')

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Boats</h5>

                    <br>
                    <a class="btn btn-info btn-block" href="{{ route('boats.create') }}">Add New Boat</a>
                    <br>
               
                </div>
                <table class="table table-striped" id="data-table-boats">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Boat Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                </table>
            </div>
                          
@endsection
