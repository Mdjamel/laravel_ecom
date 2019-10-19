<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(env('PAGINATION_COUNT'));

        return view('admin.categories.categories')->with(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required',
            'category_image' => 'required',
            'image_direction' => 'required',

        ]);

        $categoryName = $request->category_name;
        // Test category name existe 



        $category = new Category();

        $category->category_id = $request->category_id;
        $category->category_name = $categoryName;
        $category->image_direction = $request->image_direction;


        if ($request->hasFile('category_image')) {
            $image =  $request->file('category_image');

            $path = $image->store('images');

            $category->image_url = $path;
        }



        $category->save();
        $request->session()->flash('message',  'Category saved');
        return back();
    }
}
