<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate());
    }

    public function show($id)
    {
        return new CategoryResource(Category::find($id));
    }

    public function products($id)
    {
        $category = Category::find($id);
        return  ProductResource::collection($category->products()->paginate());
    }
}
