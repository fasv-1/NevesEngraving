<?php

namespace App\Http\Controllers;

use App\Models\Pedido_Produto;
use App\Models\Pedido_Detalhe;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    public function __construct(Pedido_Produto $Pedido_Produto)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->Pedido_Produto = $Pedido_Produto;
        
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
        $request->validate($this->Pedido_Produto->rules(), $this->Pedido_Produto->feedback());

        $pedido = Pedido_Detalhe::find($request->input('pedido_id'));

        // dd($pedido);


        $pedido->produtos()->attach( //o metodo attach permite inserir registros na BD através da relação belongsToMany feita no modelo pedido; attach(<id relacionado com id em questão, neste caso produto_id>, <array com o valor a iserir na coluna extra da tabela de relação>)
            $request->input('produto_id'),
            [
                'quantidade' =>$request->input('quantidade'),
                'cor' => $request->input('cor'),
                'texto' => $request->input('texto')
            ]
        );

        // $this->Pedido_Produto->create($request->all());

        return response()->json(['msg' => 'Produto do pedido adicionado com sucesso'], 201);
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
    public function destroy($id)
    {
        //
    }
}
