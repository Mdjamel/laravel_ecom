<?php

namespace App\Http\Controllers\Api;


use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection(Country::paginate());
    }


    public function showStates($id)
    {
        $country =  Country::find($id);
        return StateResource::collection($country->states);
    }

    public function showcities($id)
    {
        $country =  Country::find($id);
        return StateResource::collection($country->cities);
    }
}
