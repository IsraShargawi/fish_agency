
@extends('cpanel')
@section('title', 'Show Order Details')
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
                <div class="card">
                    <div class="card-header" > 
                        <h3>Order Details </h3>                    
                    </div>
                    <div class="card-body">

                        <table  class='table table-striped'>   
                            <tr>
                                <td style="font-weight:bold;">Order Status</td>
                                <td>   
                                    {{$order->is_approved? 'Approved' : 'Pending'}}
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
                                        @foreach ($order->details as $item)
                                        <tr>
                                            <td>{{$item->fishType->name}}</td>
                                            <td>{{$item->quntity}}</td>
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
