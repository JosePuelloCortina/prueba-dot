<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;

class RoleController extends Controller
{
    //
    public function index(){
        $roles = Role::All();
        return view('guest',[
            'roles' => $roles
        ]);
    }
}
