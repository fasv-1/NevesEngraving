<?php

namespace App\Http\Controllers;

use App\Models\imagens_produto;
use Illuminate\Http\Request;

class ImagensProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $imagensProdutos = new imagens_produto();
        $request->validate($imagensProdutos->rules(), $imagensProdutos->feedback());

        $image = $request->file('nome');
        $image_urn = $image->store('images/produtos', 'public');
        dd('ficheiros guardados');
        $imagensProdutos->create([
            'nome' => $image_urn,
            'produto_id' => $request->produto_id
        ]);

        return response()->json($imagensProdutos, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(imagens_produto $imagens_produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(imagens_produto $imagens_produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, imagens_produto $imagens_produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(imagens_produto $imagens_produto)
    {
        //
    }
}
