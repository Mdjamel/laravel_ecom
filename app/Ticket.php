<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title', 'status','ticket_type_id','user_id',
        'order_id','message'

    ];

    public function ticketType(){
        return $this->belongsTo('App\TicketType');
    }
}
