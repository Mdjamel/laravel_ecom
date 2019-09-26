@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reviews</div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($reviews as $review)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">
                                <p> {{ $review->customer->formattedName() }}</p>
                                <p>{{ $review->product->title }}</p>
                                <p>Stars :
                                    @for ($i = 0; $i < $review->stars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor

                                        @for ($i = $review->stars; $i < 5; $i++) <i class="far fa-star"></i>
                                            @endfor
                                </p>

                                <p>{{ $review->review }}</p>
                                <p>Date {{ $review->created_at->diffForHumans() }}</p>


                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $reviews->links() }}

                </div>
            </div>
        </div>



    </div>

</div>
@endsection