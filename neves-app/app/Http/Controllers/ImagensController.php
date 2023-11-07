<?php

namespace App\Http\Controllers;

use App\Models\imagens;
use Illuminate\Http\Request;

class ImagensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagens = imagens::all();

        return $imagens;
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
        $imagens = new imagens();
        $request->validate($imagens->rules(), $imagens->feedback());

        $image = $request->file('nome');

        if ($request->desconto_id != '') {

            $image_urn = $image->store('images/descontos', 'public');
        } else {
            $image_urn = $image->store('images/gerais', 'public');
        }

        $imagens->create([
            'nome' => $image_urn,
            'utilidade' => $request->utilidade,
            'desconto_id' => $request->desconto_id
        ]);

        return response()->json($imagens, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagens = imagens::find($id);

        return $imagens;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(imagens $imagens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $imagens = imagens::find($id);

        if ($imagens === null) {
            return response()->json(['error' => 'Impossivel realizar o update, o id identificado não existe'], 404);
        }

        $regrasDinamicas = [];

        if ($request->method() === 'PATCH') { //update com possibilidade de lidar com o metodo PUT e PATCH

            //percorrer todas as regras definidas no Model
            foreach ($imagens->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requesição
                if (array_key_exists($input, $request->all())) { // array_key_exists(chave a ser pesquisada, array onde pesquisar essa chave)
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $imagens->feedback());
        } else {
            $request->validate($imagens->rules(), $imagens->feedback());
        }
        // dd($request->method()); //retorna o verbo http utilizado 

        $imagens->fill($request->all());



        // remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if ($request->file('nome')) {
            // Storage::disk('public')->delete($imagens->nome);
            $image = $request->file('nome');
            if ($request->desconto_id != '' || $imagens->desconto_id != '') {
                $image_urn = $image->store('images/descontos', 'public');
            } else {
                $image_urn = $image->store('images/gerais', 'public');
            }
            $imagens->nome = $image_urn;
        }


        //Como o laravel não reconhece o verbo PUT e PATCH é necessário defenir no Postman por baixo dos valore e através do metodo POST o key "_method" e o valor "put" ou "patch"
        $imagens->save();



        // $imagens->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(imagens $imagens)
    {
        //
    }
}
