<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Image;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(env('PAGINATION_COUNT'));
        $currencyCode = env('CURRENCY_CODE', '$');
        return view('admin.products.products')->with(
            [
                'products' => $products,
                'currency_code' => $currencyCode
            ]
        );
    }

    public function newProduct($id = null)
    {
        $product = null;

        $units = Unit::all();
        $categories = Category::all();

        if (!is_null($id)) {
            $product = Product::find($id);
        }

        return view('admin.products.new-product')->with(['product' => $product, 'units' => $units, 'categories' => $categories]);
    }

    public function update(Request $request)
    { }

    public function store(Request $request)
    {

        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',

        ]);

        $product = new Product();

        $product->title = $request->product_title;
        $product->description = $request->product_description;
        $product->unit =  intval($request->product_unit);
        $product->price =  doubleval($request->product_price);
        $product->total = doubleval($request->product_total);
        $product->discount = doubleval($request->product_discount);
        $product->category_id = intval($request->product_category);

        if (!is_null($request->options)) {
            $options = array_unique($request->options);
            $optionsArray = [];

            foreach ($options as $option) {
                $actualOptions = $request->input($option);

                $optionsArray[$option] = [];

                foreach ($actualOptions as $key => $actualOption) {
                    array_push($optionsArray[$option], $actualOption);
                }
            }
            $product->options = json_encode($optionsArray);
        }

        $product->save();


        if ($request->hasFile('product_images')) {
            $images =  $request->file('product_images');
            //  dd($images);
            foreach ($images as $image) {
                $path = $image->store('images');

                /* Storage::disk('local')->put($image.);
                $path = Storage::disk('local')->path(); */



                Image::create([
                    'product_id' => intval($product->id),
                    'url' => $path
                ]);
            }
        }


        $request->session()->flash('message', 'Product saved with success');

        return redirect(route('products'));
    }

    public function delete($id)
    { }


    public function show()
    {
        $url  = Storage::url('xvnfhAHfoHMYkYOEfHeeQXhmuJvhbQoTQ4b82QTt.png');
        return "<img src='" . $url . "'/>";
    }
}
