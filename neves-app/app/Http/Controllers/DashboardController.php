<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class DashboardController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct()
{
    $this->middleware(['role:Super-Admin|Admin']);
    // $this->middleware(['role:Super-Admin']);
}
    public function index()
    {
        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token', ['App-manage']);

        $token = $tokenResult->plainTextToken;

        return view('dashboard', compact('token'));

    }
}
