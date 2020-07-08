<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    public function index() {
        $users = User::all();
        $data = array(
            'users'     =>     $users,
        );

        
        return view('users.index')->with($data);
    }

}
