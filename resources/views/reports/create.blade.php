@extends('cpanel')
@section('title', 'إضافة طلب')
@section('content')

<div class="container">
    <br> 
    <hr>
    <div class="container">
       <div class="row clearfix">
          <div class="col-md-12">
            <h4 class="card-title mt-3 text-center">إنشاء طلب</h4>
            <div class="tab">
                <div class="tab-header">
                    <button class="tablinks" onclick="openTap(event, 'payment')">الدفع</button>
                    <button class="tablinks" onclick="openTap(event, 'info')">معلومات العميل</button>
                    <button class="tablinks cart active" onclick="openTap(event, 'cart')">سلة الشراء</button>
                </div>
                <br>
                {!! Form::open(['url' => 'admin-dashboard/orders','files' => true]) !!}
                <div id="cart" class="tabcontent">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <tr>
                                <th class="text-center"> # </th>
                                <th class="text-center">   المنتج  </th>
                                <th class="text-center">   الكمية  </th>
                                <th class="text-center">  السعر  </th>
                                <th class="text-center">  المجموع  </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='addr0'>
                                <td>1</td>
                                <td>
                                    <select name="items_id[]" class="select-item form-control">
                                        <option value="">المنتج</option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}" class="form-control" > {{$item->name}} {{$item->unit->title}} </option>
                                        @endforeach
                                    </select> 
                                </td>
                                <td>
                                    <select name='qty[]' class="select-qty form-control">
                                        <option value="">الكمية</option>
                                        @for ($i = 1;$i <= 20; $i++)
                                            <option value="{{$i}}" class="form-control" @if($i == 1) selected @endif> {{$i}} </option>
                                        @endfor
                                    </select>
                                    {{--  <input type="number" name='qty[]' placeholder="الكمية" class="form-control qty" step="0" min="0"required/>  --}}
                                </td>
                                <td><input type="number" name='price[]' placeholder="السعر" value="0" class="form-control price" readonly/></td>
                                <td><input type="number" name='total[]' placeholder='0.00' value="0" class="form-control total" readonly/></td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <input type="button" value="اضف" id="add_row" class="btn btn-default pull-left"/>
                            <input type="button" value="احذف" id='delete_row' class="pull-right btn btn-default"/>
                        </div>
                    </div>
                    <div class="row clearfix" style="margin-top:20px">
                        <div class="pull-right col-md-4">
                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                <tbody>
                                    <tr>
                                        <th class="text-center">الاجمالي</th>
                                        <td class="text-center"><input type="number" name='gross_total' value='0.00' class="form-control gross_total" id="gross_total" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">التخفيض</th>
                                        <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <input type="number" class="form-control" id="discount" name="discount" value="0">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">المجموع بعد الخفيض</th>
                                        <td class="text-center"><input type="number" name='net_total' id="net_total" value='0.00' class="form-control" readonly/>
                                            <span>الطلب مضاف اليه سعر التوصيل</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="info" class="tabcontent">
                    <p class="divider-text">
                        <span class="bg-light"></span>
                    </p>

                    <div class="form-group">
                        <p>نوع العميل</p>
                        <select class="form-control" name="customer_type" id="customer_type" required>
                            <option value="old" >قديم</option>
                            <option value="new" >جديد</option>
                        </select>
                    </div>
                    <div class="form-group" id="old-customers">
                        <p> رقم العميل</p>
                        <input type="text" class="form-control customers mobile"  placeholder="رقم الهاتف">
                        <input type="hidden" class="form-control" id="customer_id_input" name="customer_id">
                        {{--  <select class="form-control customers" name="customer_id" required>
                        <option value="" ></option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" > {{ $customer->name }} </option>
                            @endforeach
                        </select>  --}}
                    </div>

                    <div class="form-group d-none" id="new-customer">
                        <div class="form-group input-group">
                            <input name="name" class="form-control customer-data" placeholder="اسم العميل" type="text">
                        </div>
                        <div class="form-group input-group">
                            <input name="mobile" class="form-control customer-data" pattern="[09|01][0-9]{9}" placeholder="رقم الهاتف" type="text">
                        </div>
                        <div class="form-group input-group">
                            <input name="mobile2" class="form-control customer-data" pattern="[09|01][0-9]{9}" placeholder="رقم الهاتف الثاني" type="text">
                        </div>
                        <div class="form-group input-group">
                            <input name="password" class="form-control customer-data" placeholder="كلمة المرور" type="text">
                        </div>
                        <select name="city_id" class="customer-data select-city form-group form-control input-group">
                            <option value="">المدن</option>
                            @foreach ($cities as $city)
                             <option value="{{$city->id}}" class="form-control" > {{$city->name}} </option>
                            @endforeach
                        </select>
                        <select name="area_id" class="customer-data select-area form-group form-control input-group">
                            <option value="">المناطق</option>
                           
                        </select>
                        <div class="form-group input-group">
                            <textarea name="description" class="form-control customer-data" placeholder="الوصف"></textarea>
                        </div>
                    </div>  
                </div>
                <div id="payment" class="tabcontent">
                    <label for="cash">
                        نقداً
                        <input type="radio" name="payment_method" required='required' class="form-control" value="0" id="cash">
                        <span class="checkmark"></span>
                    </label>
                    <label for="bank">
                        عن طريق البنك
                        <input type="radio" name="payment_method" required='required' class="form-control" value="1" id="bank">
                        <span class="checkmark"></span>
                    </label>
                    <select name="perfered_delivery_time_id" class="form-control">
                        <option value="">موعد التسليم</option>
                        @foreach ($times as $time)
                            <option value="{{$time->id}}" class="form-control" > {{$time->title}} </option>
                        @endforeach
                    </select>
                   
                </div> 
                <div class="form-group">
                    <button type="submit" style="background: rgb(31, 187, 214) !important
                    " class="btn btn-primary btn-block"> تم </button>
                </div>
            {!! Form::close() !!}
          </div>
       </div>
    </div>
</div>
</div>
    <!--container end.//--> 
@endsection

@section('page-script')
<script type="text/javascript">


 function setArea(areas){
     var id =  $('#area').val();
     for(var i = 0 ; i < areas.length ; i++){
         if(areas[i].id == id)
         $('#cost').val(areas[i].delivery_cost);
     }
 }


 $(document).ready(function(){
    $('.cart').click();
    let items = <?php echo $items; ?>;

     var i=1;
     $("#add_row").click(function(){b=i-1;
           $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
           $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
           i++; 
           $(".select-item").on('change', function () {
            items.map(item => {
                if(item.id == $(this).children("option:selected").val()){
                    $(this).parent().parent().find('.price').val(item.price);
                    }
                })
            });
     });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
         calc();
     });
     
     $('#tab_logic tbody').on('keyup change',function(){
         calc();
     });

     $('#discount').on('keyup change',function(){
         calc_total();
     });
    
     $(".select-item").on('change', function () {
        items.map(item => {
            if(item.id == $(this).children("option:selected").val()){
                $(this).parent().parent().find('.price').val(item.price);
            }
        })
     });
 });

 
 function calc()
 {
     $('#tab_logic tbody tr').each(function(i, element) {
         var html = $(this).html();
         if(html!='')
         {
            var qty = $(this).find('.select-qty').children("option:selected").val();
            let price = $(this).find('.price').val();
            $(this).find('.total').val(qty*price);
            calc_total();
         }
     });
 }

 
 function calc_total()
 {
     total=0;
     $('.total').each(function() {
         total += parseInt($(this).val());
     });
     $('#gross_total').val(total.toFixed(2));
     let net_total = total - $('#discount').val() + 75;
     $('#net_total').val(net_total.toFixed(2));
 }

 
    function openTap(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      if(evt.currentTarget)
      evt.currentTarget.className += " active";
    }

</script>
@stop