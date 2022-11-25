@extends('cpanel')
@section('title', __('strings.edit_agency'))
@section('content')

        {!! Form::open(['url' => 'admin-dashboard/agencies/'.$agency->id,'files' => true]) !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">{{__('strings.edit_agency')}}</h4>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{$agency->title}}" name="title" placeholder="{{__('strings.title')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group input-group">
                            <img src="{{ $agency->image_full_path }}" alt="about Img" width="300" height="300" >
                            {!! Form::file('image'); !!}
                       </div>
                    </div>

                    <div class="form-group row">
                        <p>{{__('strings.description')}}</p>
                        <div class="col-sm-12">
                            {!! Form::textarea('description', $agency->description , ['class' => 'form-control', 'rows' => 5, 'required' => 'required']) !!}
                       </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="username" value="{{$agency->username}}" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">{{__('strings.add_btn')}}</buuton>
                    </div>
                </div>
            </form>
        </div> 
        {!! Form::close() !!}
 
@endsection
