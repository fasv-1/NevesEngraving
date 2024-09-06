<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conteudo;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class ConteudoController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct(conteudo $conteudo)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->conteudo = $conteudo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $conteudo = $this->conteudo->where($conditions[0], $conditions[1], $conditions[2])->get();
        } else {
            $conteudo = $this->conteudo->all();
        }

        return response()->json($conteudo, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->conteudo->rules(), $this->conteudo->feedback());

        

        //checks for an desconto_id to choose the right place to store
        if ($request->media != '') {

            $image = $request->file('media');

            if(explode('/', $_FILES['media']['type'])[0] == 'image'){
                $image_urn = $image->store('images/gerais', 'public');
            }else{
                $image_urn = $image->store('videos', 'public');
            }

            $this->conteudo->create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'media' => $image_urn,
                'posicao' => $request->posicao
            ]);
        } else {
            $this->conteudo->create($request->all());
        }

        return response()->json(['msg' => 'O conteudo foi adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {

            return response()->json(['error' => 'O conteudo que procura não existe'], 404);
        }

        return response()->json($conteudo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {
            return response()->json(['error' => 'Impossivel realizar o update, o id identificado não existe'], 404);
        }

        $regrasDinamicas = [];

        if ($request->method() === 'PATCH') { //update with the possibility to use the method PUT and PATCH

            //browse every rules in the Model 
            foreach ($conteudo->rules() as $input => $regra) {

                //colect only the aplied rules of request 
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $conteudo->feedback());
        } else {
            $request->validate($conteudo->rules(), $conteudo->feedback());
        }

        //checks if a file is uploded and if it is delete the image that was stored before

        if ($request->file('media')) {
            Storage::disk('public')->delete($conteudo->media);
        }

        

        $conteudo->fill($request->all());

        

        // checks for an uploaded image and if it exists stores it
        if ($request->file('media')) {

            $file = $request->file('media');

            //checks for an desconto_id to choose the right place to store
            if(explode('/', $_FILES['media']['type'])[0] == 'image'){
                $image_urn = $file->store('images/gerais', 'public');
            }else{
                $image_urn = $file->store('videos', 'public');
            }
            $conteudo->media = $image_urn;
        }
        
        //as a parameter is sent, save() recognize that is an update
        $conteudo->save();
        
        return response()->json(['msg' => 'Conteudo atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conteudo = $this->conteudo->find($id);

        if ($conteudo === null) {
            return response()->json(['error' => 'O conteudo que pretende eliminar não existe'], 404);
        }

        if ($conteudo->media != null) {
            Storage::disk('public')->delete($conteudo->media);
        }

        $conteudo->delete();
        return response()->json(['msg' => 'Conteudo eliminado com sucesso'], 200);
    }
}
