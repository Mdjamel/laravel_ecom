@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">
                                <h5>{{ $product->title }}</h5>
                                <p>Category : {{ $product->category->name }}</p>
                                <p>Price : {{ $currency_code }} {{ $product->price }} </p>
                                @if(count($product->images)> 0)
                                <img src="{{ $product->images[0]->url}}" alt="" class="img-thumbnail" card-img>
                                @endif



                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $products->links() }}

                </div>
            </div>
        </div>



    </div>

</div>

@endsection