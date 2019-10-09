<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    public function index()
    {
        return UnitResource::collection(Unit::paginate());
    }

    public function show($id)
    {
        return new UnitResource(Unit::find($id));
    }
}
