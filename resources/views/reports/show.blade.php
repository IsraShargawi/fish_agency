
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
                                <td style="font-weight:bold;">#</td>
                                <td>{{$order->id}}</td>
                            </tr>    
                            <tr>
                                <td style="font-weight:bold;">Agency</td>
                                <td> {{ $order->agency->name }} </td>
                            </tr>
                           
                            <tr>
                                <td style="font-weight:bold;">Order Status</td>
                                <td>   
                                    <input type="hidden" id="order_id" value="{{$order->id}}">
                                    <select class="form-control select-status" required>
                                        <option value="1" @if($order->is_approved) selected="selected" @endif> Approved</option>  
                                        <option value="0" @if(!$order->is_approved) selected="selected" @endif> Pending</option>  
                                    </select>
                                </td>
                            </tr>
                            <tr>    
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">Fish Type</th>
                                        <th scope="col">Quntity</th>                         
                                        <th scope="col">Current in Stock</th>                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->details as $item)
                                        <tr>
                                            <td>{{$item->fishType->name}}</td>
                                            <td>{{$item->quntity}}</td>
                                            <td>{{$item->fishType->quntity}}</td>
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
