<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Image;

class ImageController extends Controller
{
    public function index()
    {
        return ImageResource::collection(Image::paginate());
    }

    public function show($id)
    {
        return new ImageResource(Image::find($id));
    }
}
