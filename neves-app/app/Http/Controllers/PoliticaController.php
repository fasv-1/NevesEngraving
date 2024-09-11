<?php

namespace App\Http\Controllers;

use App\Models\Politica;
use Illuminate\Http\Request;

class PoliticaController extends Controller
{
    public function __construct(Politica $politica)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->politica = $politica;
        
        // $this->middleware(['role:User|Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $politicas = $this->politica->get();

         if ($request->has('filtro')) {
             $conditions = explode(':', $request->filtro);
             $politicas = $politicas->where($conditions[0], $conditions[1], $conditions[2]);
 
             if (isset($conditions[3])) {
                 $politicas = $politicas->where($conditions[0], $conditions[1], $conditions[2])->where($conditions[3], $conditions[4], $conditions[5]);
             }
         } else {
             $politicas = $politicas;
         }

         return response()->json(['policies' => $politicas ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->politica->rules(), $this->politica->feedback());

        $this->politica->create($request->all());

        return response()->json(['msg' => 'Politica adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $politica = $this->politica->find($id);

        return response()->json($politica, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $politicas = $this->politica->find($id);

        if ($politicas === null) {
            return response()->json(['error' => 'A politica que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($politicas->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $politicas->feedback());
        } else {
            $request->validate($politicas->rules(), $politicas->feedback());
        }

        $politicas->update($request->all());

        return response()->json(['msg' => 'Politica atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $politicas = $this->politica->find($id);

        if ($politicas === null) {
            return response()->json(['error' => 'A politica que pretende eliminar não existe'], 404);
        }

        $politicas->delete();

        return response()->json(['msg' => 'Politica eliminada com sucesso'], 200);
    }
}
