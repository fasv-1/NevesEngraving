<?php

namespace App\Http\Controllers\Custos_envio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\envio_portugal;

class EnvioPortugalController extends Controller
{
    public function index(){

        $envio_pt = envio_portugal::all();

        return response()->json($envio_pt, 200);
    }

    public function store(Request $request) {

        $envio_pt = new envio_portugal();

        $request->validate($envio_pt->rules(), $envio_pt->feedback());

        $envio_pt->create($request->all());

        return response()->json(['msg' => 'Porte de envio adicionado com sucesso'], 201);
    }

    public function destroy($id) {

        $envio_pt = envio_portugal::find($id);

        $envio_pt->delete();

        return response()->json(['msg' => 'Porte de envio eliminado com sucesso'], 201);
    }
}
