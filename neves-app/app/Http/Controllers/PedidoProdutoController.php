<?php

namespace App\Http\Controllers;

use App\Models\Pedido_Produto;
use App\Models\Pedido_Detalhe;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct()
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        
        // $this->middleware(['role:User|Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido_produto = new Pedido_Produto();
        $request->validate($pedido_produto->rules(), $pedido_produto->feedback());

        $pedido = Pedido_Detalhe::find($request->input('pedido_id'));


        $pedido->produtos()->attach( 
            $request->input('produto_id'),
            [
                'quantidade' =>$request->input('quantidade'),
                'cor' => $request->input('cor'),
                'texto' => $request->input('texto')
            ]
        );

        return response()->json(['msg' => 'Produto associado ao pedido com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $pedido = Pedido_Detalhe::find($id);

        $pedido->produtos()->detach($request->input('produto_id'));

        return response()->json(['msg' => 'Produto desassociado do pedido'], 201);
    }
}
