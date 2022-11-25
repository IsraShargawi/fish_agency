
@extends('cpanel')
@section('title', 'Show Fish Load Details')
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
                <div class="card">
                    <div class="card-header" > 
                        <h3>Load Details </h3>                    
                    </div>
                    <div class="card-body">

                        <table  class='table table-striped'>   
                            <tr>
                                <td style="font-weight:bold;">Boat Name</td>
                                <td>   
                                    {{$load->boat->name}}
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Expired At</td>
                                <td>   
                                    {{$load->expired_date->format('d M Y - H:i:s')}}
                                </td>
                            </tr>
                            <tr>
                               
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">Fish Type</th>
                                        <th scope="col">Quntity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($load->details as $item)
                                        <tr>
                                            <td>{{$item->fishType->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </tr>
                        </table>
                    </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>
@endsection
