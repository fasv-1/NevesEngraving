<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
{
    $this->middleware(['role:Super-Admin|Admin']);
    // $this->middleware(['role:Super-Admin']);
}
    public function index()
    {
        $user = Auth::user();

        if ($user->status == 5) {
            return view('dashboard');
        } else {
            return redirect('/');
        }
    }
}
