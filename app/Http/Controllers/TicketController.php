<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::paginate(env('PAGINATION_COUNT'));
        return view('admin.tickets.tickets')->with(['tickets'=>$tickets]);
    }
}
