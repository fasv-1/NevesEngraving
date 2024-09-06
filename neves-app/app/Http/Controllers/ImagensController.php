<?php

namespace App\Http\Controllers;

use App\Models\imagens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagens = imagens::all();

        return response()->json($imagens, 200);
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

        //capture the file and stores it with an acronym given by laravel
        $image = $request->file('nome');

        //checks for an desconto_id to choose the right place to store
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

        return response()->json(['msg'=>'imagem adicionada com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagens = imagens::find($id);

        return response()->json($imagens, 200);
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

        if ($request->method() === 'PATCH') { //update with the possibility to use the method PUT and PATCH

            //browse every rules in the Model 
            foreach ($imagens->rules() as $input => $regra) {

                //colect only the aplied rules of request 
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $imagens->feedback());
        } else {
            $request->validate($imagens->rules(), $imagens->feedback());
        }

        //checks if a file is uploded and if it is delete the image that was stored before

        if ($request->file('nome')) {
            Storage::disk('public')->delete($imagens->nome);
        }

        $imagens->fill($request->all());

        

        // checks for an uploaded image and if it exists stores it
        if ($request->file('nome')) {

            $image = $request->file('nome');

            //checks for an desconto_id to choose the right place to store
            if ($imagens->desconto_id != '') {
                $image_urn = $image->store('images/descontos', 'public');
            } else {
                $image_urn = $image->store('images/gerais', 'public');
            }
            $imagens->nome = $image_urn;
        }
        //as a parameter is sent, save() recognize that is an update
        $imagens->save();
        
        return response()->json(['msg' => 'Imagem atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imagens = imagens::find($id);

        //remind to use the facades
        Storage::disk('public')->delete($imagens->nome);

        $imagens->delete();

        return response()->json(['msg' => 'Imagem eliminada com sucesso'], 200);
    }
}
