<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(env('PAGINATION_COUNT'));

        return view('admin.tags.tags')->with(['tags'=>$tags]);

    }
}
