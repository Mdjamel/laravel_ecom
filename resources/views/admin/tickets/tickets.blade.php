@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tickets</div>

                <div class="card-body">
                    <div class="row">

                        @foreach ($tickets as $ticket)
                        <div class="col-md-4">
                            <div class="alert alert-primary" role="alert">
                                <h5> {{ $ticket->customer->formattedName() }}</h5>
                                <p> {{ $ticket->status }}</p>
                                <p> {{ $ticket->title }}</p>

                                {{--  <p> {{ $ticket->ticketType->name }}</p> --}}

                            </div>
                        </div>

                        @endforeach
                    </div>

                    {{ $tickets->links() }}

                </div>
            </div>
        </div>



    </div>

</div>
@endsection