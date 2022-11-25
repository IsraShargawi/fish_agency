@extends('cpanel')
@section('title', 'Create Order')
@section('content')
    <div class="container">
        <br>
        <hr>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12">
                    <h4 class="card-title mt-3 text-center">Create Order</h4>
                    {!! Form::open(['url' => 'agency-dashboard/agency_orders','files' => true]) !!}
                    <div class="table-responsive">
                        <table class="table" id="tableSocProducts">
                            <thead>
                                <tr>
                                    <td class="text-weight-semibold">Fish Type</td>
                                    <td class="text-weight-semibold">Qty</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="50%">
                                        <select name="fish_type_ids[]" class="text form-control" aria-label="Default select example" required>
                                            @foreach ($fish_types as $type)
                                                <option value="{{$type->id}}"> {{$type->name}} </option>
                                            @endforeach
                                        </select> 
                                    </td>
                                    <td width="50%">
                                        <input name="qty[]" type="number" value=""  class="text form-control" required/>
                                    </td>                        
                                    <td>
                                        <div class="">
                                            <button id="addNewItem" name="addNewItem" type="button"
                                                class="btn btn-success add"><i style="color:#fff"
                                                    class="fa fa-plus-circle"></i></button>
                                            <button id="removeItem" name="removeItem" type="button"
                                                class="btn btn-danger remove"><i style="color:#fff;"
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Submit </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--container end.//-->
@endsection

@section('page-script')
    <script type="text/javascript">
        var editableProducts = {
            options: {
                table: "#tableSocProducts"
            },
            initialize: function() {
                this
                    .setVars()
                    .events();
            },
            setVars: function() {
                this.$table = $(this.options.table);
                this.$totalLines = $(this.options.table).find('tr').length - 1;
                return this;
            },
            updateLines: function() {
                var totalLines = $(this.options.table).find('tr').length - 1;
                if (totalLines <= 1) {
                    $('.remove').hide();
                    $('.add').show();
                }

                return this;
            },
            events: function() {
                var _self = this;

                _self.updateLines();

                this.$table
                    .on('click', 'button.add', function(e) {
                        e.preventDefault();
                        //---------------------------------------

                        var $tr = $(this).closest('tr');
                        var $clone = $tr.clone();
                        $clone.find('.text').val('');
                        $tr.after($clone);

                        if (_self.setVars().$totalLines > 1) {
                            $('.remove').show();
                        }

                        $tr.find('.add').hide();

                    })
                    .on('click', 'button.remove', function(e) {
                        e.preventDefault();
                        //---------------------------------------

                        var $tr = $(this).closest('tr')
                        $tr.remove();

                        if (_self.setVars().$totalLines <= 1) {
                            $('.remove').hide();
                            $('.add').show();
                        }
                        //if have delete last button with button add visible, add another button to last tr
                        if (_self.setVars().$totalLines > 1) {
                            _self.$table.find('tr:last').find('.add').show();
                        }

                    });

                return this;
            }
        };

        $(function() {
            editableProducts.initialize();
        });
    </script>
@stop
