<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
{   
    public function index(){

        $states = State::paginate(env(' PAGINATION_COUNT'));
        return view('admin.states.states')->with(['states'=>$states]);

    }
}
