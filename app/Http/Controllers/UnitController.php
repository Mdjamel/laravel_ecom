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


    private function unitNameExiste($unitName)
    {
        $unit  = Unit::where('unit_name', '=', $unitName)->first();
        if (!is_null($unit)) {
            return false;
        }
        return true;
    }

    private function unitCodeExiste($unitCode)
    {
        $unit  = Unit::where('unit_code', '=', $unitCode)->first();
        if (!is_null($unit)) {
            return false;
        }
        return true;
    }


    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);

        $unit = new Unit;

        if (!$this->unitNameExiste($request->unit_name)) {
            $request->session()->flash('message', ' Unit name' . $request->unit_name . ' existe');

            return redirect()->back();
        }

        if (!$this->unitCodeExiste($request->unit_code)) {
            $request->session()->flash('message', ' Unit code' . $request->unit_code . ' existe');

            return redirect()->back();
        }

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




        if (!$this->unitNameExiste($request->unit_name)) {
            $request->session()->flash('message', ' Unit name' . $request->unit_name . ' existe');

            return redirect()->back();
        }
        if (!$this->unitCodeExiste($request->unit_code)) {
            $request->session()->flash('message', ' Unit code' . $request->unit_code . ' existe');

            return redirect()->back();
        }


        $unit->unit_code = $request->unit_code;
        $unit->unit_name = $request->unit_name;

        $unit->save();
        $request->session()->flash('message', 'Unit ' . $request->unit_name . ' updated');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_unit' => 'required',
        ]);

        $units = Unit::where('unit_name', 'LIKE', '%' . $request->search_unit . '%')->orwhere('unit_code', 'LIKE', '%' . $request->search_unit . '%')->paginate(env('PAGNIATION_COUNT'));

        if (count($units) > 0) {
            return view('admin.units.units')->with(['units' => $units]);
        }

        $request->session()->flash('message', 'Nothing found');
        return redirect()->back();
    }
}
