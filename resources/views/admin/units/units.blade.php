@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Units</div>

                <div class="card-body">

                    <form action=" {{ route('units') }}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="unit_name">Unit Name</label>
                            <input class="form-control" type="text" id="unit_name" name="unit_name" required
                                placeholder="Unit Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_code">Unit Code</label>
                            <input class="form-control" type="text" id="unit_code" name="unit_code" required
                                placeholder="Unit Code">
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Save New Unit</button>
                        </div>
                    </form>


                    <div class="row">
                        @foreach ($units as $unit)
                        <div class="col-md-3">


                            <div class="alert alert-primary" role="alert">
                                <span class="btn-span">
                                    <span>
                                        <a class="edit-unit" data-unitid="{{ $unit->id }}"
                                            data-unitname="{{ $unit->unit_name }}"
                                            data-unitcode="{{ $unit->unit_code }}"><i
                                                class="fas fa-pencil-alt"></i></i></a>
                                    </span>
                                    <span>
                                        <a class="delete-unit" data-unitid="{{ $unit->id }}"><i
                                                class=" fa fa-trash"></i></a>
                                    </span>
                                </span>

                                <p>{{ $unit->unit_name }}, {{ $unit->unit_code }}</p>

                            </div>
                        </div>

                        @endforeach
                    </div>



                    {{ $units->links() }}

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

<div class="modal " tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('units') }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p id="unit_delete_message"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                <input type="hidden" name="unit_id" id="unit_id">

            </form>


        </div>

    </div>
</div>

<div class="modal " tabindex="-1" role="dialog" id="edit-window">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('units') }}" method="post">
                @csrf
                @method('put')

                <div class="form-group col-md-6">
                    <label for="edit_unit_name">Unit Name</label>
                    <input class="form-control" type="text" id="edit_unit_name" name="unit_name" required
                        placeholder="Unit Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="edit_unit_code">Unit Code</label>
                    <input class="form-control" type="text" id="edit_unit_code" name="unit_code" required
                        placeholder="Unit Code">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                <input type="hidden" name="unit_id" id="edit_unit_id">

            </form>


        </div>

    </div>
</div>




@section('script')

<script>
    $(document).ready(function(){
        var $deleteUnit =  $('.delete-unit');
        var $deleteWindow = $('#delete-window');
        var $unitId = $('#unit_id');
        var $unit_delete_message = $('#unit_delete_message');

        $deleteUnit.on('click', function(e){
            e.preventDefault();
            $unit_name = $(this).data('unitname') ;
            $unit_delete_message.text('Are you sure to delete '+ $unit_name)
            $unit_ID = $(this).data('unitid') ;
            $unitId.val($unit_ID);
            
            $deleteWindow.modal('show');

        })

        //Edit 
        
        var $editUnit =  $('.edit-unit');
        var $editWindow = $('#edit-window');


        $edit_unit_name = $('#edit_unit_name');
        $edit_unit_code = $('#edit_unit_code');
        $edit_unit_id = $('#edit_unit_id');
        
        
        $editUnit.on('click', function(e){
            e.preventDefault();
            

            unit_code = $(this).data('unitcode') ;
            unit_name = $(this).data('unitname') ;
            unit_ID = $(this).data('unitid');         



            $edit_unit_code.val(unit_code);
            $edit_unit_name.val(unit_name);
            $edit_unit_id.val(unit_ID);
            
            
            $editWindow.modal('show');

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


@endsection