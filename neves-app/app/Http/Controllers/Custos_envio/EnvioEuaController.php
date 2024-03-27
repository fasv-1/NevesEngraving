<?php

namespace App\Http\Controllers\Custos_envio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\envio_eua;

class EnvioEuaController extends Controller
{
    public function index(){

        $envio_eua = envio_eua::all();

        return response()->json($envio_eua, 200);
    }

    public function store(Request $request) {

        $envio_eua = new envio_eua();

        $request->validate($envio_eua->rules(), $envio_eua->feedback());

        $envio_eua->create($request->all());

        return response()->json(['msg' => 'Porte de envio adicionado com sucesso'], 201);
    }

    public function destroy($id) {

        $envio_eua = envio_eua::find($id);

        $envio_eua->delete();

        return response()->json(['msg' => 'Porte de envio eliminado com sucesso'], 201);
    }
}
