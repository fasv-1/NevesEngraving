<?php

namespace App\Http\Controllers;

use App\Models\taxa;
use Illuminate\Http\Request;

class TaxaController extends Controller
{
    public function __construct(taxa $taxa)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->taxa = $taxa;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $taxa = $this->taxa->where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $taxa = $this->taxa->all();
        }


        return response()->json($taxa, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->taxa->rules(), $this->taxa->feedback());

        $this->taxa->create($request->all());

        return response()->json(['msg' => 'A taxa foi adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taxa = $this->taxa->find($id);

        if ($taxa === null) {

            return response()->json(['error' => 'A taxa que procuta não existe'], 404);
        }

        return response()->json($taxa, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taxa = $this->taxa->find($id);

        if ($taxa === null) {

            return response()->json(['error' => 'A taxa que pretende atualizar não existe'], 404);
        } else {

            //makes separation of the methods
            if ($request->method() === 'PATCH') {
                $dinamycRules = [];

                //browse all rules for indentify the especific key and rule that's been recive, save them in the dinamycRules variable
                foreach ($taxa->rules() as $input => $rules) {
                    if (array_key_exists($input, $request->all())) {
                        $dinamycRules[$input] = $rules;
                    }
                }

                //validation with the dinamic rules
                $request->validate($dinamycRules, $taxa->feedback());
            } else {
                $request->validate($taxa->rules(), $taxa->feedback());
            }

            $taxa->update($request->all());

            return response()->json(['msg' => 'Taxa atualizado com sucesso'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taxa = $this->taxa->find($id);

        if ($taxa === null) {
            return response()->json(['error' => 'A taxa que pretende eliminar não existe'], 404);
        }

        $taxa->delete();
        return response()->json(['msg' => 'Taxa eliminada com sucesso'], 200);
    }
}
