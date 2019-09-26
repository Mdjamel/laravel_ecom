@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($tags as $tag)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">
                                <h5>{{ $tag->tag }}</h5>
                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $tags->links() }}

                </div>
            </div>
        </div>



    </div>

</div>
@endsection