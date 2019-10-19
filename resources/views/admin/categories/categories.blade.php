@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    <form action=" {{ route('categories') }}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="category_name">Category Name</label>
                            <input class="form-control" type="text" id="category_name" name="category_name" required
                                placeholder="Category Name">
                        </div>
                        <div class="form-group">
                            <label for="category_image">Category Image</label>
                            <input type="file" class="form-control-file" id="category_image" name="category_image">
                        </div>

                        <div class="form-group col-md-12">
                            <label class="form-check-label" for="imagedirection">
                                Image Direction
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imagedirection" id="imagedirection"
                                    value="left" checked>
                                <label class="form-check-label" for="imagedirection">
                                    Left
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imagedirection" id="imagedirection"
                                    value="right">
                                <label class="form-check-label" for="imagedirection">
                                    Right
                                </label>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Save New Unit</button>
                        </div>
                    </form>

                    <div class="row">

                        @foreach ($categories as $category)
                        <div class="col-md-3">
                            <div class="alert alert-primary" role="alert">
                                <p>{{ $category->name }}</p>

                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $categories->links() }}

                </div>
            </div>
        </div>



    </div>

</div>

@endsection