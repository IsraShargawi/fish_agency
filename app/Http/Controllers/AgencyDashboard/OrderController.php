<?php

namespace App\Http\Controllers\AgencyDashboard;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\FishType;
use DataTables;

class OrderController extends Controller
{

    public function index()
    {
        return view('agency_orders.index');
    }

    public function indexData(Request $request)
    {
        $orders = [];
        if ($request->get('date_range') == 'All') {
            $orders = Order::with(['details'])
            ->orderBy('created_at', 'DESC')->get();
        } else {
            $date = explode(" - ", $request->get('date_range'));
            $orders = Order::with(['details'])
            ->whereBetween('created_at', [$date[0],$date[1]])
            ->orderBy('created_at', 'DESC')->get();
        }

        return DataTables::of($orders)
            ->addColumn('order_status', function ($order) {
                return  $order->is_approved ? 'Approved' : 'Pending';
            })
            ->addColumn('total', function ($order) {
                return  $order->order_details_count;
            })
            ->addColumn('created_at', function ($order) {
                return $order->created_at->format('d M Y - H:i:s');
            })
            ->addColumn('view', function ($order) {
                $action = '<a href="/agency-dashboard/agency_orders/' . $order->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                return $action;
            })
            ->addColumn('edit', function ($order) {
                $action = '<a href="/agency-dashboard/agency_orders/' . $order->id . '/edit" class="btn btn-xs btn-primary"><i class="far fa-edit"></i></a>';
                return $action;
            })
            ->editColumn('id', '{{$id}}')
            ->rawColumns(['view', 'edit'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $fish_types = FishType::get();
        return view('agency_orders.create', compact('fish_types'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'fish_type_ids' => 'required',
            'qty' => 'required',
        ]);
        $order = Order::create(['agency_id' => session()->get('agency')->id]);
        $fish_types = $input['fish_type_ids'];
        $qtys = $input['qty'];
        foreach ($fish_types as $index => $type_id) {
            $order_detail = new OrderDetails();
            $order_detail->order_id = $order->id;
            $order_detail->quntity = $qtys[$index];
            $order_detail->fish_type_id = $type_id;
            $order_detail->save();
        }
        return redirect()->action([OrderController::class, 'index']);
    }

    public function show($id)
    {
        $order = Order::with(['details'])
        ->find($id);
        return view('agency_orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $order_statuses = OrderStatus::get();
        return view('agency_orders.edit', compact('orders_statuses', 'order'));
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
}
