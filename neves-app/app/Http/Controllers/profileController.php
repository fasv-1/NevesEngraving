<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function profile () {
        $data = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'Acesso garantido',
            'data' => $data

        ]);
    }
}
