<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    public function index(){
        $cities = City::paginate(env('PAGNITATION_COUNT'));
        return view('admin.cities.cities')->with(['cities'=>$cities]);
    }
}
