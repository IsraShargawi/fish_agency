<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Boat;
use App\Models\FishLoadDetails;
use App\Models\FishLoad;
use DataTables;

class ReportController extends Controller
{

    public function reportLoads()
    {
        $boats = Boat::get();
        return view('reports.loads', compact('boats'));
    }

    public function reportLoadsData(Request $request)
    {
        $orders;
        $boat_id = $request->get('boat_id');
        if ($request->get('date_range') == 'All') {
            $loads = FishLoadDetails::with(['fishType'])
            ->orderBy('created_at', 'DESC')->get();
        } else {
            $date = explode(" - ", $request->get('date_range'));
            $loads = FishLoadDetails::with(['fishType'])
            ->whereBetween('created_at', [$date[0],$date[1]])
            ->orderBy('created_at', 'DESC')->get();
        }

        $l_loads = [];
        foreach ($loads as $key => $load) {
            $fish_load = FishLoad::with('boat')
            ->where('boat_id', $boat_id)
            ->where('id', $load->fish_load_id)->first();
            if($fish_load != null){
                $load->boat = $fish_load->boat->name;
                array_push($l_loads, $load);
            }
        }

        // return $loads;
        return DataTables::of($l_loads)
            ->addColumn('boat', function ($load) {
                return $load->boat;
            })
            ->addColumn('fish', function ($load) {
                return  $load->fishType->name;
            })
            ->addColumn('quntity', function ($load) {
                return  $load->quantity;
            })
            ->addColumn('created_at', function ($load) {
                return $load->created_at->format('d M Y - H:i:s');
            })
            // ->addColumn('view', function ($order) {
            //     $action = '';
            //     $action .= '<a href="/admin-dashboard/orders/' . $order->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            //     ;
            //     return $action;
            // })
            // ->addColumn('edit', function ($order) {
            //     $action = '';
            //     $action .= '<a href="/admin-dashboard/orders/' . $order->id . '/edit" class="btn btn-xs btn-primary"><i class="far fa-edit"></i></a>';
            //     ;
            //     return $action;
            // })
            ->editColumn('id', '{{$id}}')
            ->rawColumns(['products','customer','view', 'edit'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['status_id'] = 1;

        // Check for new customers

        $customer;
        if (isset($input['customer_type']) && ($input['customer_type'] === 'new')) {
            $customer = Customer::create([
                'name' => $input['name'],
                'mobile' => $input['mobile'],
                'mobile2' => $input['mobile2'],
                'area_id' => $input['area_id'],
                'description' => $input['description'],
                'password' => $input['password'],
            ]);
            $input['customer_id'] = isset($input['customer_id']) ? $input['customer_id'] : $customer->id;
        }

        if (!$input['customer_id']) {
            return redirect()->back()->with('alert', 'الزبون غير موجود');
        }

        $order = Order::create($input);

        $items = $input['items_id'];
        $qtys = $input['qty'];
        $prices = $input['price'];

        foreach ($items as $index => $item_id) {
            $item = Item::find($item_id);
            $order_item = new OrderItem();
            $order_item->item_id = $item_id;
            $order_item->quntity = $qtys[$index];
            $order_item->order_id = $order->id;
            $order_item->price = $item->price;
            $order_item->cost = $item->cost;
            $order_item->save();
        }

        return redirect()->action('OrderController@index');
    }

    public function show($id)
    {
        $order = Order::with(['details', 'agency'])
        ->find($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $order_statuses = OrderStatus::get();
        return view('orders.edit', compact('orders_statuses', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $order = Order::find($id);

        $order->update($input);

        $order->save();

        return redirect()->back()->with('success', 'Cost Updated Successfully');
    }

    public function changeOrderStatus($order_id, $status_id)
    {
        $order = Order::find($order_id);
        $available = true;
        if($status_id == "1"){
            foreach ($order->details as $item){
                if($item->quntity > $item->fishType->quntity)
                    $available = false;
            }
            if($available == "1") {
                $order->is_approved = $status_id;
                $order->save();
            }         
        }
        return $available? 'Success' : 'Faild';
    }
}
