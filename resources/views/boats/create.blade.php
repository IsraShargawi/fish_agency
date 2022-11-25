@extends('cpanel')
@section('title', 'Add New Boat')
@section('content')

        {!! Form::open(['url' => 'admin-dashboard/boats','files' => true]) !!}
            <div class="card">
                <form class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Add New Boat</h4>
                    
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        
                        <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div> 
        {!! Form::close() !!}
 
@endsection
