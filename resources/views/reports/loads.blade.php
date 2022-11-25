@extends('cpanel')

@section('title', 'Orders')

@section('content')

    <div class="card" style="overflow-x: scroll">
        <div class="card-body">
            <h5 class="card-title m-b-0"> Orders</h5>
            <br>
            <div class="form-group">
                <select name="boat_id" class="form-control" id="boat">
                    <option value="0"> Filter By Boat </option>
                    @foreach ($boats as $boat)
                        <option value="{{$boat->id}}"> {{$boat->name}} </option>
                    @endforeach
                </select> 
                <label for="daterange-field">Choose a period of time: :</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="date_range" id="daterange-field"
                        autocomplete="off">
                    <div class="input-group-addon" style="padding: 0px;">
                        <button class=" btn-primary" style="margin: 0px;padding: 7px;" name="filter" id="filter"><i
                                class="fa fa-search"></i> </button>
                    </div>
                </div>
            </div>
            {{--  <a class="btn btn-info btn-block" href="{{ route('orders.create') }}">{{__('strings.create_label')}}</a>  --}}
            <br>

        </div>
        <table class="table table-striped" id="data-table-report-loads">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Boat</th>
                    <th scope="col">Fish</th>
                    <th scope="col">Quntity</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection
