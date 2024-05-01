<?php

namespace App\Http\Controllers;

use App\Models\termoEcondicao;
use Illuminate\Http\Request;

class TermoEcondicaoController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct(termoEcondicao $termoEcondicao)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->termoEcondicao = $termoEcondicao;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $termoEcondicao = $this->termoEcondicao->where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $termoEcondicao = $this->termoEcondicao->all();
        }


        return response()->json($termoEcondicao, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->termoEcondicao->rules(), $this->termoEcondicao->feedback());

        $this->termoEcondicao->create($request->all());

        return response()->json(['msg' => 'O termo/condição foi adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $termoEcondicao = $this->termoEcondicao->find($id);

        if ($termoEcondicao === null) {

            return response()->json(['error' => 'O termo/condição que procura não existe'], 404);
        }

        return response()->json($termoEcondicao, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $termoEcondicao = $this->termoEcondicao->find($id);

        if ($termoEcondicao === null) {

            return response()->json(['error' => 'O termo/condição que pretende atualizar não existe'], 404);
        } else {

            //makes separation of the methods
            if ($request->method() === 'PATCH') {
                $dinamycRules = [];

                //browse all rules for indentify the especific key and rule that's been recive, save them in the dinamycRules variable
                foreach ($termoEcondicao->rules() as $input => $rules) {
                    if (array_key_exists($input, $request->all())) {
                        $dinamycRules[$input] = $rules;
                    }
                }

                //validation with the dinamic rules
                $request->validate($dinamycRules, $termoEcondicao->feedback());
            } else {
                $request->validate($termoEcondicao->rules(), $termoEcondicao->feedback());
            }

            $termoEcondicao->update($request->all());

            return response()->json(['msg' => 'Termo/condição atualizado com sucesso'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $termoEcondicao = $this->termoEcondicao->find($id);

        if ($termoEcondicao === null) {
            return response()->json(['error' => 'O termo/condição que pretende eliminar não existe'], 404);
        }

        $termoEcondicao->delete();
        return response()->json(['msg' => 'Termo/condição eliminado com sucesso'], 200);
    }
}
