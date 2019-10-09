<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return ReviewResource::collection(Review::paginate());
    }

    public function show($id)
    {
        return new ReviewResource(Review::find($id));
    }
}
