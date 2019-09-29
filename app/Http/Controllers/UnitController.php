<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    public function index()
    {

        $units = Unit::paginate(env('PAGINATION_COUNT'));
        return view('admin.units.units')->with(
            ['units' => $units]
        );
    }

    public function showAdd()
    {
        return view('admin.units.add_edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);

        $unit = new Unit;
        $unit->unit_name = $request->unit_name;
        $unit->unit_code = $request->unit_code;

        $unit->save();

        $request->session()->flash('message', ' Unit' . $unit->unit_name . ' has been added');

        return redirect()->back();
    }

    public function delete(Request $request)
    {

        //  dd($request);
        if (is_null($request->unit_id) || (empty($request->unit_id))) {
            $request->session()->flash('message', 'Unit ID is required');
            return redirect()->back();
        }

        $id = $request->unit_id;
        Unit::destroy($id);
        $request->session()->flash('message', 'Unit has been deleted');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        //  dd($request);
        $request->validate([
            'unit_code' => 'required',
            'unit_id' => 'required',
            'unit_name' => 'required',
        ]);

        $id =  intval($request->unit_id);

        $unit = Unit::find($id);

        $unit->unit_code = $request->unit_code;
        $unit->unit_name = $request->unit_name;

        $unit->save();
        $request->session()->flash('message', 'Unit ' . $request->unit_name . ' updated');
        return redirect()->back();
    }
}
