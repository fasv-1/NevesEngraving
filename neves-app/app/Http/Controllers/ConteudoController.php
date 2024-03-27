<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conteudo;

class ConteudoController extends Controller
{
    public function __construct(conteudo $conteudo)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->conteudo = $conteudo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $conteudo = $this->conteudo->where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $conteudo = $this->conteudo->all();
        }


        return response()->json($conteudo, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->conteudo->rules(), $this->conteudo->feedback());

        $this->conteudo->create($request->all());

        return response()->json(['msg' => 'O conteudo foi adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {

            return response()->json(['error' => 'O conteudo que procura não existe'], 404);
        }

        return response()->json($conteudo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {

            return response()->json(['error' => 'O conteudo que pretende atualizar não existe'], 404);
        } else {

            //makes separation of the methods
            if ($request->method() === 'PATCH') {
                $dinamycRules = [];

                //browse all rules for indentify the especific key and rule that's been recive, save them in the dinamycRules variable
                foreach ($conteudo->rules() as $input => $rules) {
                    if (array_key_exists($input, $request->all())) {
                        $dinamycRules[$input] = $rules;
                    }
                }

                //validation with the dinamic rules
                $request->validate($dinamycRules, $conteudo->feedback());
            } else {
                $request->validate($conteudo->rules(), $conteudo->feedback());
            }

            $conteudo->update($request->all());

            return response()->json(['msg' => 'Conteudo atualizado com sucesso'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {
            return response()->json(['error' => 'O conteudo que pretende eliminar não existe'], 404);
        }

        $conteudo->delete();
        return response()->json(['msg' => 'Conteudo eliminado com sucesso'], 200);
    }
}
