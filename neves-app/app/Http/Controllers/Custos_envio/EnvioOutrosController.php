<?php

namespace App\Http\Controllers\Custos_envio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\envio_outros;

class EnvioOutrosController extends Controller
{
    public function index(){

        $envio_out = envio_outros::all();

        return response()->json($envio_out, 200);
    }

    public function store(Request $request) {

        $envio_out = new envio_outros();

        $request->validate($envio_out->rules(), $envio_out->feedback());

        $envio_out->create($request->all());

        return response()->json(['msg' => 'Porte de envio adicionado com sucesso'], 201);
    }

    public function destroy($id) {

        $envio_out = envio_outros::find($id);

        $envio_out->delete();

        return response()->json(['msg' => 'Porte de envio eliminado com sucesso'], 201);
    }
}
