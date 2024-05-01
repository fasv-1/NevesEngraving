<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdutoDetalhe;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $produtoDetalhe = ProdutoDetalhe::where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $produtoDetalhe = ProdutoDetalhe::all();
        }
        

        return response()->json($produtoDetalhe, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $produtoDetalhe = new ProdutoDetalhe;

        $request->validate($produtoDetalhe->rules(), $produtoDetalhe->feedback());

        $produtoDetalhe->create($request->all());

        return response()->json(['msg' => 'Detalhe adicionado com sucesso'], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){

        $produtoDetalhe = ProdutoDetalhe::find($id);

        if ($produtoDetalhe === null) {
            return response()->json(['error' => 'O detalhe que pretende eliminar não existe'], 404);
        }

        $produtoDetalhe->delete();
        return response()->json(['msg' => 'Detalhe eliminado com sucesso'], 200);

    }
}
