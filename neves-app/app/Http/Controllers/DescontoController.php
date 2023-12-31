<?php

namespace App\Http\Controllers;

use App\Models\Desconto;
use Illuminate\Http\Request;

class DescontoController extends Controller
{
    //injects the model instance in the controller
    public function __construct(Desconto $desconto)
    {
        $this->desconto = $desconto;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $descontos = $this->desconto->all();

        return $descontos;
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

        $discount = $this->desconto->create($request->all());

        return ['msg'=>'Desconto adicionado com sucesso'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $descontos = $this->desconto->find($id);

        return $descontos;
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
            return response()->json(['error' => 'A categoria que pretende atualizar não existe'], 404);
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

        return ['msg'=>'Desconto atualizado com sucesso'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discount = $this->desconto->find($id);

        if ($discount === null) {
            return response()->json(['error' => 'A categoria que pretende eliminar não existe'], 404);
        }

        $discount->delete();

        return ['msg'=>'Desconto eliminado com sucesso'];
    }
}
