<?php

namespace App\Http\Controllers;

use App\Models\Desconto;
use Illuminate\Http\Request;
use App\Repositories\DescontoRepo;

class DescontoController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    //injects the model instance in the controller
    public function __construct(Desconto $desconto)
    {
        $this->desconto = $desconto;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $descontoRepo = new DescontoRepo($this->desconto);

        if ($request->has('filtro')) {

            $descontoRepo->filter($request->filtro);

            $descontos = $descontoRepo->getResult($request->filtro);
        } else {
            $descontos = $descontoRepo->getResult('allDiscount');
        }

        return response()->json($descontos, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->desconto->rules(), $this->desconto->feedback());

        $this->desconto->create($request->all());

        return response()->json(['msg'=>'Desconto adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $descontoRepo = new DescontoRepo($this->desconto);

        $descontos = $descontoRepo->findResult('desconto', $id);

        if ($descontos === null) {

            return response()->json(['error' => 'O conteudo que procura não existe'], 404);
        }

        return response()->json($descontos, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desconto $desconto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $discount = $this->desconto->find($id);

        if ($discount === null) {
            return response()->json(['error' => 'O desconto que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($discount->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $discount->feedback());
        } else {
            $request->validate($discount->rules(), $discount->feedback());
        }

        $discount->update($request->all());

        return response()->json(['msg'=>'Desconto atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discount = $this->desconto->find($id);

        if ($discount === null) {
            return response()->json(['error' => 'O desconto que pretende eliminar não existe'], 404);
        }

        $discount->delete();

        return response()->json(['msg'=>'Desconto eliminado com sucesso'], 200);
    }
}
