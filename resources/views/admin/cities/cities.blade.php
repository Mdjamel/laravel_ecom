@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">City</div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($cities as $city)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">
                                <h5>{{ $city->name }}</h5>
                                <p>Country : {{ $city->country->name }}</p>
                                <p>State : {{ $city->state->name }}</p>

                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $cities->links() }}

                </div>
            </div>
        </div>



    </div>

</div>
@endsection