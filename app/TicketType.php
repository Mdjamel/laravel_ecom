<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = [
        'name',
    ];


    public function tockets(){
        return $this->hasMany('App\Ticket');
    }
}
