<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::paginate(env('PAGINATION_COUNT'));
        return view('admin.countries.countries')->with(['countries'=>$countries]);
    }
}
