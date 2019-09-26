<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
   public function index(){
       $roles = Role::paginate(env('PAGINATION_COUNT'));
       return view('admin.roles.roles')->with(['roles'=> $roles]);
   }
}
