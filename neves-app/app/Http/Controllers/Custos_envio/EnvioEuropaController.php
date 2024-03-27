<?php

namespace App\Http\Controllers\Custos_envio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\envio_europa;

class EnvioEuropaController extends Controller
{
    public function index(){

        $envio_eu = envio_europa::all();

        return response()->json($envio_eu, 200);
    }

    public function store(Request $request) {

        $envio_eu = new envio_europa();

        $request->validate($envio_eu->rules(), $envio_eu->feedback());

        $envio_eu->create($request->all());

        return response()->json(['msg' => 'Porte de envio adicionado com sucesso'], 201);
    }

    public function destroy($id) {

        $envio_eu = envio_europa::find($id);

        $envio_eu->delete();

        return response()->json(['msg' => 'Porte de envio eliminado com sucesso'], 201);
    }
}
