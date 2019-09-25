<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    public function users(){
        return $this.belongsToMany('App\user');
    }
}
