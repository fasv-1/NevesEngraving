<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materia_prima;

class MateriaPrimaController extends Controller
{
    //injects the model instance in the controller
    public function __construct(materia_prima $material){
        $this->material = $material;
    }
    
    /**
     * Display all the resource.
     */
    public function show(Request $request)
    {
        $materiais = $this->material->all();

        return response()->json($materiais , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation of request
        $request->validate($this->material->rules(), $this->material->feedback());

        $materiais = $this->material->create($request->all());

        return response()->json(['msg'=>'Matéria-prima adicionada com sucesso'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $material = $this->material->find($id);

        if($material === null){
            return response()->json([ 'error' => 'O material que pretende atualizar não existe' ], 404);
        }

        //validation of request
        $request->validate($this->material->rules(), $this->material->feedback());

        $material->update($request->all());
        
        return response()->json(['msg'=>'Matéria-prima atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $material = $this->material->find($id);

        if($material === null){
            return response()->json(['error' => 'O material que pretende eliminar não existe'], 404);
        }

        $material->delete();

        return response()->json(['msg'=>'Matéria-prima eliminada com sucesso'], 200);
    }
}
