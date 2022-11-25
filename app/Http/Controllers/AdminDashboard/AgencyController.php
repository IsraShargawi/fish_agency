<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Order;
use DataTables;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agencies.index');
    }

    public function indexData()
    {
        // $agencies = Agency::with('items')->get();
        $agencies = Agency::get();

        return DataTables::of($agencies)
            ->addColumn('orders_count', function ($agency) {
                return Order::where('agency_id', $agency->id)->count();
            })
            ->addColumn('created_at', function ($agency) {
                return $agency->created_at->format('Y-m-d');
            })
            ->addColumn('view', function ($agency) {
                return '<a href="/admin-dashboard/agencies/' . $agency->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            })
            ->addColumn('edit', function ($agency) {
                return '<a href="/admin-dashboard/agencies/' . $agency->id . '/edit" class="btn btn-xs btn-primary"><i class="far fa-edit"></i></a>';
            })
            ->rawColumns(['view', 'edit'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencies = Agency::get();
        return view('agencies.create', compact('agencies'));
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
        $request->validate([
            'email' => 'required|unique:agencies',
            'password' => [
                'required',
                'min:6',
                // 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                // 'confirmed'
            ],
        ]);
        $input['password'] = $input['password'] ? Hash::make($input['password']) : '';
        $agency = Agency::create($input);
        return redirect()->action([AgencyController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = Agency::find($id);

        return view('agencies.show', compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::find($id);

        return view('agencies.edit', compact('agency'));
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
        $agency = Agency::find($id);
        $agency->update($input);
        return redirect()->action([AgencyController::class, 'index']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
