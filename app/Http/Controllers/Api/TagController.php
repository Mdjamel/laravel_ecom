<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::Collection(Tag::paginate());
    }

    public function show($id)
    {
        return new TagResource(Tag::find($id));
    }
}
