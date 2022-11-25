@extends('cpanel')
@section('title', 'تعديل بيانات الطلب')
@section('content')

        {!! Form::open(['url' => 'admin-dashboard/orders/'.$order->id,'files' => true]) !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">تعديل بيانات الطلب</h4>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="ordering" value="{{$order->ordering}}"  placeholder="{{__('strings.ordering')}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{$order->name}}" name="name" placeholder="{{__('strings.name')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{$order->name_en}}" name="name_en" placeholder="{{__('strings.name_en')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group input-group">
                            <img src="{{ $order->image_full_path }}" alt="order Img" width="300" height="300" >
                            {!! Form::file('image'); !!}
                       </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{ $order->cv_full_path }}" target="_blank"> السيرة الذاتية </a>
                        <div class="form-group input-group">
                            {!! Form::file('cv'); !!}
                       </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control"  name="description" placeholder="{{__('strings.description')}}" > {{$order->description}} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control"  name="description_en" placeholder="{{__('strings.description_en')}}" > {{$order->description_en}} </textarea>
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
