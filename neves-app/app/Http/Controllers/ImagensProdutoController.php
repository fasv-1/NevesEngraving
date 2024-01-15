<?php

namespace App\Http\Controllers;

use App\Models\imagens_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagensProdutoController extends Controller
{
    public function __construct(imagens_produto $imagens_produto)
    {
        $this->imagens_produto = $imagens_produto;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product_images = array();

        
        if ($request->has('atributos')) {
            $attributes = $request->atributos;
            $product_images = $this->imagens_produto->selectRaw($attributes)->with('produto');
        }else{
            $product_images = $this->imagens_produto->with('produto');
            
        }
        if($request->has('filtro')){
            $conditions = explode(':',$request->filtro);
            $product_images = $product_images->where($conditions[0],$conditions[1],$conditions[2])->get();
        }else{
            $product_images = $product_images->get();
        }
        return response()->json($product_images, 200);
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


        //capture the file and stores it with an acronym given by laravel
        $image = $request->file('nome');
        $image_urn = $image->store('images/produtos', 'public');

        
        $imagensProdutos->create([
            'nome' => $image_urn,
            'posicao' => $request->posicao,
            'produto_id' => $request->produto_id
        ]);

        return response()->json(['msg'=>'Imagem adicionada com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagens = imagens_produto::find($id);

        return $imagens;
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
    public function update(Request $request, $id)
    {
        $imagensProduto = imagens_produto::find($id);

        if ($imagensProduto === null) {
            return response()->json(['error' => 'Impossivel realizar o update, o id identificado não existe'], 404);
        }

        $regrasDinamicas = [];

        if ($request->method() === 'PATCH') { //update with the possibility to use the method PUT and PATCH

            //browse every rules in the Model       
            foreach ($imagensProduto->rules() as $input => $regra) {

                //colect only the aplied rules of request  
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $imagensProduto->feedback());
        } else {
            $request->validate($imagensProduto->rules(), $imagensProduto->feedback());
        }
        //checks if a file is uploded and if it is delete the image that was stored before
        if ($request->file('nome')) {
            Storage::disk('public')->delete($imagensProduto->nome);
        }

        $imagensProduto->fill($request->all());

        // checks for an uploaded image and if it exists stores it
        if ($request->file('nome')) {

            $image = $request->file('nome');
            $image_urn = $image->store('images/produtos', 'public');
            $imagensProduto->nome = $image_urn;
        }

        //as a parameter is sent, save() recognize that is an update
        $imagensProduto->save();

        return response()->json(['msg' => 'Imagem atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imagensProduto = imagens_produto::find($id);

        //remind to use the facades
        Storage::disk('public')->delete($imagensProduto->nome);

        $imagensProduto->delete();

        return response()->json(['msg'=>'Imagem eliminada com sucesso'], 200);
    }
}
