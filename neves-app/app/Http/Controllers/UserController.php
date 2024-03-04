<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
{
    // $this->middleware(['role:User|Admin']);
}
    public function index(){
        $users = User::with('roles')->get();

        return  response()->json(array('users' => $users));
    }
}
