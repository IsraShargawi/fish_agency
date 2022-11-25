<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FishLoad;
use App\Models\FishLoadDetails;
use App\Models\Boat;
use App\Models\FishType;
use DataTables;

class FishLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loads.index');
    }

    public function indexData()
    {
        $loads = FishLoad::with('boat')->get();
        return DataTables::of($loads)
        ->addColumn('boat', function ($load) {
            return $load->boat->name;
        })
        ->addColumn('created_at', function ($load) {
            return $load->created_at->format('d M Y - H:i:s');
        })
        ->addColumn('expired_date', function ($load) {
            return $load->expired_date->format('d M Y - H:i:s');
        })
        ->addColumn('view', function ($load) {
            $action = '<a href="/admin-dashboard/loads/' . $load->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            return $action;
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['view'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boats = Boat::get();
        $fish_types = FishType::get();
        return view('loads.create', compact('boats','fish_types'));
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
            'boat_id' => 'required:fish_loads',
            'expired_date' => 'required:fish_loads',
        ]);
        $load = FishLoad::create($input);

        $fish_types = $input['fish_type_ids'];
        $qtys = $input['qty'];

        foreach ($fish_types as $index => $type_id) {
            $load_details = new FishLoadDetails();
            $load_details->fish_load_id = $load->id;
            $load_details->quantity = $qtys[$index];
            $load_details->fish_type_id = $type_id;
            $load_details->save();
        }
        return redirect()->action([FishLoadController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $load = FishLoad::with(['details', 'boat'])
        ->find($id);
        return view('loads.show', compact('load'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $load = FishLoad::find($id);
        return view('loads.edit', compact('load'));
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
        $request->validate([
            'name' => 'required|unique:loads,name,' . $id,
        ]);
        $load = FishLoad::find($id);
        $load->update($input);
        return redirect()->action([FishLoadController::class, 'index']);
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
