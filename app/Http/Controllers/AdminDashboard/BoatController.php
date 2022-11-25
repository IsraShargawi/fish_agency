<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boat;
use DataTables;
// use App\Http\Traits\SlugTrait;

class BoatController extends Controller
{
    // use SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boats.index');
    }

    public function indexData()
    {
        $boats = Boat::get();
        return DataTables::of($boats)
        ->addColumn('edit', function ($boat) {
            $action = '';
            $action .= '<a href="/admin-dashboard/boats/' . $boat->id . '/edit" class="btn btn-xs btn-primary"><i class="far fa-edit"></i></a>';
            ;
            return $action;
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns([ 'edit'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boats.create');
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
            'name' => 'required|unique:boats',
        ]);
        $boat = Boat::create($input);
        return redirect()->action([BoatController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boat = Boat::find($id);
        return view('boats.show', compact('boat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boat = Boat::find($id);
        return view('boats.edit', compact('boat'));
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
            'name' => 'required|unique:boats,name,' . $id,
        ]);
        $boat = Boat::find($id);
        $boat->update($input);
        return redirect()->action([BoatController::class, 'index']);
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
