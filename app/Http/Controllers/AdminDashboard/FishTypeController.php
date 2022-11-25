<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FishType;
use DataTables;
// use App\Http\Traits\SlugTrait;

class FishTypeController extends Controller
{
    // use SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fish_types.index');
    }

    public function indexData()
    {
        $fish_types = FishType::get();

        return DataTables::of($fish_types)
        ->addColumn('edit', function ($fish_type) {
            $action = '';
            $action .= '<a href="/admin-dashboard/fish_types/' . $fish_type->id . '/edit" class="btn btn-xs btn-primary"><i class="far fa-edit"></i></a>';
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
        return view('fish_types.create');
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
            'name' => 'required|unique:fish_types',
        ]);
        $fish_type = FishType::create($input);
        return redirect()->action([FishTypeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fish_type = FishType::find($id);
        return view('fish_types.show', compact('fish_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fish_type = FishType::find($id);
        return view('fish_types.edit', compact('fish_type'));
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
            'name' => 'required|unique:fish_types,name,' . $id,
        ]);
        $fish_type = FishType::find($id);
        $fish_type->update($input);
        return redirect()->action([FishTypeController::class, 'index']);
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
