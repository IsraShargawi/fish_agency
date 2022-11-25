
@extends('cpanel')
@section('title', __('strings.show_agency'))
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="font-size: 30px"> {{__('strings.show_agency')}}                    
                        <a href="{{ url('admin-dashboard/agencies'.'/'.$agency->id.'/edit') }}"> <i class="far fa-edit"></i> </a>
                    </div>
                    <div class="card-body">

                        <table  class='table table-striped'>
                        
                        
                            <tr>
                                <td style="font-weight:bold;">#</td>
                                <td>{{$agency->id}}</td>
                            </tr> 
                            
                            <tr>
                                <td style="font-weight:bold;">{{__('strings.title')}}</td>
                                <td>{{$agency->title}}</td>
                            </tr>  

                            <tr>
                                <td style="font-weight:bold;">{{__('strings.image')}}</td>
                                <td> <img src="{{ $agency->image_full_path }}" alt="agency Image" width="300" height="300"></td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">{{__('strings.description')}}</td>
                                <td>{{$agency->description}}</td>
                            </tr>  

                                

                        </table>
                    </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>
@endsection
