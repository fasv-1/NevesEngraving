<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this-> produto= $produto;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = $this->produto->all();

        return $product;
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
        
        $product = $this->produto->create($request->all());
        
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->produto->find($id);
        
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
            return response()->json(['error' => 'A categoria que pretende atualizar não existe'], 404);
        }

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

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->produto->find($id);

        if ($product === null) {
            return response()->json(['error' => 'A categoria que pretende eliminar não existe'], 404);
        }

        $product->delete();

        return 'Produto eliminado com sucesso';
    }
}
