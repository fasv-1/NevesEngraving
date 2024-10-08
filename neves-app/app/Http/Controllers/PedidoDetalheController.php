<?php

namespace App\Http\Controllers;

use App\Models\Pedido_Detalhe;
use App\Repositories\PedidoDetalheRepo;
use Illuminate\Http\Request;


class PedidoDetalheController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct(Pedido_Detalhe $Pedido_Detalhe)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->Pedido_Detalhe = $Pedido_Detalhe;
        
        // $this->middleware(['role:User|Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $PedidoDetalheRepo = new PedidoDetalheRepo($this->Pedido_Detalhe);

        if ($request->has('filtro')) {

            $PedidoDetalheRepo->filter($request->filtro);

            $Pedido_Detalhe = $PedidoDetalheRepo->getResult($request->filtro);
        } else {
            $Pedido_Detalhe = $PedidoDetalheRepo->getResult('allOrderDetails');
        }

         return response()->json(['Pedido_Detalhe' => $Pedido_Detalhe ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->Pedido_Detalhe->rules(), $this->Pedido_Detalhe->feedback());

        $this->Pedido_Detalhe->create($request->all());

        return response()->json(['msg' => 'Detalhes do pedido adicionados com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $PedidoDetalheRepo = new PedidoDetalheRepo($this->Pedido_Detalhe);

        $Pedido_Detalhe = $PedidoDetalheRepo->findResult('detalheDoPedido', $id);

        if ($Pedido_Detalhe === null) {

            return response()->json(['error' => 'O detalhes do pedido que procura não existem'], 404);
        }

        return response()->json(['Pedido_detalhe' => $Pedido_Detalhe], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Pedido_Detalhe = $this->Pedido_Detalhe->find($id);

        if ($Pedido_Detalhe === null) {
            return response()->json(['error' => 'Os detalhes do pedido que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($Pedido_Detalhe->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $Pedido_Detalhe->feedback());
        } else {
            $request->validate($Pedido_Detalhe->rules(), $Pedido_Detalhe->feedback());
        }

        $Pedido_Detalhe->update($request->all());

        return response()->json(['msg' => 'Detalhes do pedido atualizados com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Pedido_Detalhe = $this->Pedido_Detalhe->find($id);

        if ($Pedido_Detalhe === null) {
            return response()->json(['error' => 'Os detalhes do pedido que pretende eliminar não existe'], 404);
        }

        $Pedido_Detalhe->produtos()->detach();

        $Pedido_Detalhe->delete();

        return response()->json(['msg' => 'Detalhes do pedido eliminados com sucesso'], 200);
    }
}
