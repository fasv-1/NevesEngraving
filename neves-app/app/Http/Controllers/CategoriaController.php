<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //injects the model instance in the controller
    public function __construct(categoria $categoria)
    {
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
        

        return $categorias;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validação do request

        $request->validate($this->categoria->rules(), $this->categoria->feedback());

        $this->categoria->create($request->all());

        return ['msg' => 'Categoria foi adicionada com sucesso'];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoria->find($id);

        if ($category === null) {
            return response()->json(['error' => 'A categoria que pretende atualizar não existe'], 404);
        }

        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($category->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $category->feedback());
        } else {
            $request->validate($category->rules(), $category->feedback());
        }

        $category->update($request->all());

        return ['msg' => 'Categoria foi atualizada com sucesso'];
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
        return ['msg' => 'Categoria foi eliminada com sucesso'];
    }
}
