@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {!! !is_null($product)? 'Update Product <span
                        class="product-header-title">'.$product->title.'</span>':'New product' !!}
                </div>

                <div class="card-body">
                    <form action="{{  (is_null($product))? route('new-product') :route('update-product') }} "
                        enctype="multipart/form-data" method="post" class="row">
                        @csrf
                        @if (!is_null($product))
                        @method('PUT')
                        @endif

                        <div class="form-group col-md-12">
                            <label for="product_title">Product Title</label>
                            <input class="form-control" type="text" id="product_title" name="product_title" required
                                placeholder="Product Title" value="{{ !is_null($product)? $product->title: '' }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control" type="text" id="product_description"
                                name="product_description" required
                                placeholder="Product Description"> {{ !is_null($product)? $product->description: '' }} </textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_category">Product Category</label>
                            <select name="product_category" id="product_category" class="form-control" required>
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ (!is_null($product) && $product->category->id == $category->id) ?   'selected' : ''  }}>
                                    {{ $category->name }}
                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_unit">Product Units</label>
                            <select name="product_unit" id="product_unit" class="form-control" required>
                                @foreach ($units as $unit)

                                <option value="{{ $unit->id }}"
                                    {{ (!is_null($product) && $product->hasUnit->id == $unit->id) ?   'selected' : ''  }}>
                                    {{ $unit->formattedUnit() }}
                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group-inline col-md-6">

                            <label for="product_price">Product Price</label>
                            <input class="form-control" type="number" step="any" id="product_price" name="product_price"
                                required placeholder="Product Price"
                                value="{{ !is_null($product)? $product->price: '' }}">
                        </div>

                        <div class="form-group col-md-6">

                            <label for="product_discount">Product Discount</label>
                            <input class="form-control" type="number" step="any" id="product_discount"
                                name="product_discount" required placeholder="Product Discount"
                                value="{{ !is_null($product)? $product->discount: '' }}">
                        </div>

                        <div class="form-group col-md-12">

                            <label for="product_total">Product Total</label>
                            <input class="form-control" type="number" step="any" id="product_total" name="product_total"
                                required placeholder="Product Total"
                                value="{{ !is_null($product)? $product->total: '' }}">
                        </div>

                        <div class="form-group col-md-12">

                            <table id="optiontable" class="table table-striped">

                            </table>
                            <a href="#" class="btn btn-outline-dark add_option"> Add Option</a>
                        </div>

                        {{-- Images  --}}
                        <div class="form-group col-md-12">
                            <div class="row">
                                @for ($i = 0; $i < 6; $i++) <div class="col-md-4 col-sm-12 mb-4">

                                    <div class="card image-card-upload">
                                        <a href="#" class="activate-image-upload" data-fileid="image-{{ $i }}">
                                            <div class="card-body " style="text-align:center">
                                            </div>

                                        </a>
                                        <input name="product_images[]" type="file"
                                            class="form-control-file image-file-upload" id="image-{{ $i }}">
                                    </div>
                            </div>
                            @endfor
                        </div>
                </div>

                <div class=" form-group col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary btn-block ">Save </button>
                </div>


                </form>

            </div>
        </div>
    </div>
</div>
</div>

<div class="modal " tabindex="-1" role="dialog" name="option-window" id="option-window">
    <div class="modal-dialog" role="document">

        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body row">
                <div class="form-group col-md-6">
                    <label for="option_name">Option Name</label>
                    <input class="form-control" type="text" id="option_name" name="option_name" required
                        placeholder="Option Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="option_value">Option Value</label>
                    <input class="form-control" type="text" id="option_value" name="option_value" required
                        placeholder="Option value">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_option_btn">Add Option</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>



        </div>

    </div>
</div>



@endsection

@section('script')
<script>
    $(document).ready(function(){

        var $optionWindow = $('#option-window');
        var $optionBtn = $('.add_option');
        var optionNamesList = [];
        var optionsListrow='';

        var activateImageUpload = $('.activate-image-upload ');
        var imageFileUpload = $('.image-file-upload ');

        


        $optionBtn.on('click', function(e){
            e.preventDefault();
            $optionWindow.modal('show');

        })

        $(document).on('click', '.remove-option', function(e){
            e.preventDefault();
            $(this).parent().parent().remove();


        })

   

        $(document).on('click', '.add_option_btn', function(){
            var $optionName = $('#option_name');
            var $optionValue = $('#option_value');

            if($optionName.val() == '') {
                alert('Option Name is required');
                return false;
            }

            if($optionValue.val() == '') {
                alert('Option Value is required');
                return false;
            }

            var $optionTable = $('#optiontable');

            
            if(!optionNamesList.includes($optionName.val())){
                optionNamesList.push($optionName.val());
                optionsListrow = '<td><input type="hidden" name="options[]" value="'+$optionName.val()+'"></td>';
            }
            

        var row = `
                <tr>
                  <td>  
                        `+$optionName.val()+`  
                  </td>  
                  <td>  
                    `+$optionValue.val()+`
                  </td>  

                  <td>  
                    <a href="" class="remove-option"> <i class=" fa fa-trash"></i></a>
                    <input type="hidden" name="`+$optionName.val()+`[]" value="`+$optionValue.val()+`">
                  </td>  

                </tr>    
        `
      

        $optionTable.append(row);
        $optionTable.append(optionsListrow);

        
        $optionValue.val('');

        })


        function readURL(input, imageID) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                
                reader.onload = function(e) {
                   
                $('#'+imageID).attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
         }
        

        activateImageUpload.on('click', function(e){
            e.preventDefault();
            
            var fileUploadID = $(this).data('fileid');
            $('#'+fileUploadID).trigger('click');
            var imageTag = '<img id="i'+fileUploadID+'" src=""  class="card-img-top"  >';
            $(this).append(imageTag);

            $('#'+fileUploadID).on('change', function(){
                readURL(this, 'i'+fileUploadID);
            })
           
        })

   

})
</script>

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