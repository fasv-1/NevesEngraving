<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ProdutoController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = array();


        if ($request->has('atributos')) {
            $attributes = $request->atributos;
            $product = $this->produto->selectRaw($attributes)->with('desconto')->with('materiaPrima')->with('ocasioes')->with('categoria');
        } else {
            $product = $this->produto->with('desconto')->with('materiaPrima')->with('ocasioes')->with('categoria');
        }

        if($request->has('intervalo')){
            $values = explode(':', $request->intervalo);
            $product = $this->produto->whereBetween($values[0], [$values[1], $values[2]]);
        } else{
            $product = $product;
        }

        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $product = $product->where($conditions[0], $conditions[1], $conditions[2]);

            if (isset($conditions[3])) {
                $product = $product->where($conditions[0], $conditions[1], $conditions[2])->where($conditions[3], $conditions[4], $conditions[5]);
            }
        } else {
            $product = $product;
        }

        if ($request->has('deleted')) { // finds every regists even the ones who are deleted(softDeletes)
            $product = $product->onlyTrashed()->get();
        } else {
            $product = $product->get();
        }

        return response()->json($product, 200);
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
        $request->validate($this->produto->rules(), $this->produto->feedback());

        $this->produto->create($request->all());

        return response()->json(['msg' => 'Produto registado com sucesso'], 200);;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->produto->with('desconto')->with('categoria')->with('materiaPrima')->with('ocasioes')->with('categoria')->find($id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = $this->produto->find($id);

        if ($product === null) {
            //gets all the eliminated (softDeletes) products
            $product = $this->produto->onlyTrashed()->get();
            if ($product) {
                foreach ($product as $element) {
                    if ($element->id == $id) { //compares with the recived id
                        $element->restore(); // restore it permanently

                        return response()->json(['msg' => 'Produto restaurado com sucesso'], 200);
                    }
                }
            } else {
                return response()->json(['error' => 'O produto que pretende atualizar não existe'], 404);
            }
        } else {

            //makes separation of the methods
            if ($request->method() === 'PATCH') {
                $dinamycRules = [];

                //browse all rules for indentify the especific key and rule that's been recive, save them in the dinamycRules variable
                foreach ($product->rules() as $input => $rules) {
                    if (array_key_exists($input, $request->all())) {
                        $dinamycRules[$input] = $rules;
                    }
                }

                //validation with the dinamic rules
                $request->validate($dinamycRules, $product->feedback());
            } else {
                $request->validate($product->rules(), $product->feedback());
            }

            $product->update($request->all());

            return response()->json(['msg' => 'Produto atualizado com sucesso'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->produto->find($id);

        if ($product === null) {
            //gets all the eliminated (softDeletes) products
            $product = $this->produto->onlyTrashed()->get();
            if ($product) {
                foreach ($product as $element) { //compares with the recived id
                    if ($element->id == $id) {
                        $element->forceDelete(); // eliminates permanently

                        return response()->json(['msg' => 'Produto eliminado permanentemente'], 200);
                    }
                }
            } else {
                return response()->json(['error' => 'O produto que pretende eliminar não existe'], 404);
            }
        }

        $product->delete();

        return response()->json(['msg' => 'Produto eliminado com sucesso'], 200);
    }
}
