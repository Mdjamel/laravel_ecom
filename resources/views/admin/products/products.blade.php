@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products (List) <a class="btn btn-primary" href="{{ route('new-product') }}">
                        <i class=" fas
                        fa-plus"></i></a>
                </div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">

                                <h5>{{ $product->title }}</h5>
                                <p>Category : {{ $product->category->name }}</p>
                                <p>Price : {{ $currency_code }} {{ $product->price }} </p>
                                @if(count($product->images)> 0)
                                <img src="{{ asset($product->images[0]->url)}}   " alt="" class="img-thumbnail"
                                    card-img>
                                @endif


                                @if (!is_null($product->options))
                                <div class="form-group col-md-12">
                                    @foreach ($product->jsonFormat() as $key=>$optionsvalue)
                                    <label for="{{ $key }}"> {{ strtoupper($key) }}</label>
                                    <select name="{{ $key }}" id="{{ $key }} " class="form-control">
                                        @foreach ($optionsvalue as $option)
                                        <option>{{ strtoupper( $option) }}</option>
                                        @endforeach
                                    </select>
                                    @endforeach
                                </div>
                                @endif
                                {{-- 
                                @if (! is_null($product->options))
                                <table class="table table-border">
                                    @foreach ($product->jsonFormat() as $optionkey=>$options)
                                    @foreach ($options as $option)
                                    <tr>
                                        <td>{{ $optionkey }}</td>
                                <td>{{ $option }}</td>
                                </tr>
                                @endforeach

                                @endforeach
                                </table>

                                @endif --}}


                                <a href="{{ route('update-product', $product->id) }}"
                                    class="btn btn-success mt-2">Update Product</a>
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

<div class="toast" style="position: absolute; top: 5%; right: 5%;">
    <div class="toast-header">

        <strong class="mr-auto">Unit</strong>

        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        {{ Session::get('message') }}
    </div>
</div>

@endsection


@section('script')
@if(Session::has('message'))
<script>
    $(document).ready(function() {
        $toast =  $('.toast').toast({
            autohide:false
        });

        $toast.toast('show');
    })
</script>
@endif
@endsection