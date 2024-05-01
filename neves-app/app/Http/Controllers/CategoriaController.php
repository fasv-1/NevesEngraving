<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    //injects the model instance in the controller
    public function __construct(categoria $categoria)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->categoria = $categoria;
    }

    /**
     * Display all the resource.
     */
    public function show(Request $request)
    {
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $categorias = $this->categoria->where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $categorias = $this->categoria->all();
        }
        

        return response()->json($categorias, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validação do request

        $request->validate($this->categoria->rules(), $this->categoria->feedback());

        $this->categoria->create($request->all());

        return response()->json(['msg' => 'Categoria foi adicionada com sucesso'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoria->find($id);

        $request->validate($this->categoria->rules(), $this->categoria->feedback());

        if ($category === null) {
            return response()->json(['error' => 'A categoria que pretende atualizar não existe'], 404);
        }

        $category->update($request->all());

        return response()->json(['msg' => 'Categoria foi atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $category = $this->categoria->find($id);

        if ($category === null) {
            return response()->json(['error' => 'A categoria que pretende eliminar não existe'], 404);
        }

        $category->delete();
        return response()->json(['msg' => 'Categoria foi eliminada com sucesso'], 200);
    }
}
