<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdutoDetalhe;
use App\Repositories\ProdDetalheRepo;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(ProdutoDetalhe $detalhe)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->detalhe = $detalhe;

        // $this->middleware(['role:User|Admin']);
    }
    public function index(Request $request)
    {

        $detalheRepo = $this->detalhe;

        if ($request->has('filtro')) {

            $filtros = explode(';', $request->filtro);

            foreach ($filtros as $key => $condicao) {

                $c = explode(':', $condicao);
                $detalheRepo = $this->detalhe->where($c[0], $c[1], $c[2]);
            }

            // $detalheRepo->filter($request->filtro);

            $produtoDetalhe = $detalheRepo->get();
        } else {
            $produtoDetalhe = $detalheRepo->getResult('allProdDetails');
        }

        // dd($produtoDetalhe);


        return response()->json($produtoDetalhe, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produtoDetalhe = $this->detalhe;

        $request->validate($produtoDetalhe->rules(), $produtoDetalhe->feedback());

        $produtoDetalhe->create($request->all());

        return response()->json(['msg' => 'Detalhe adicionado com sucesso'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $produtoDetalhe = $this->detalhe->find($id);

        if ($produtoDetalhe === null) {
            return response()->json(['error' => 'O detalhe que pretende eliminar não existe'], 404);
        }

        $produtoDetalhe->delete();
        return response()->json(['msg' => 'Detalhe eliminado com sucesso'], 200);
    }
}
