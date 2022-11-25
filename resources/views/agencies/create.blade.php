@extends('cpanel')
@section('title', 'Add Agency')
@section('content')

    {!! Form::open(['url' => 'admin-dashboard/agencies', 'files' => true]) !!}
    <div class="card">
        <form class="form-horizontal">
            <div class="card-body">
                <h4 class="card-title">Add Agency</h4>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">Submit</buuton>
                    </div>
                </div>
        </form>
    </div>
    {!! Form::close() !!}

@endsection
