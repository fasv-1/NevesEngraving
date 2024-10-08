<?php

namespace App\Http\Controllers;

use App\Models\Ocasiao;
use Illuminate\Http\Request;
use App\Repositories\OcasiaoRepo;

class OcasiaoController extends Controller
{

    /**
     * Build some intructions to the controller
     */
    //injects the model instance in the controller
    public function __construct(Ocasiao $ocasiao)
    {
        $this->ocasiao = $ocasiao;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ocasiaoRepo = new OcasiaoRepo($this->ocasiao);

        if ($request->has('filtro')) {

            $ocasiaoRepo->filter($request->filtro);

            $ocasioes = $ocasiaoRepo->getResult($request->filtro);
        } else {
            $ocasioes = $ocasiaoRepo->getResult('allOcasions');
        }

        return response()->json($ocasioes, 200);
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
        $request->validate($this->ocasiao->rules(), $this->ocasiao->feedback());

        $this->ocasiao->create($request->all());

        return response()->json(['msg'=>'Ocasião adicionada com sucesso'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ocasiaoRepo = new OcasiaoRepo($this->ocasiao);

        $ocasioes = $ocasiaoRepo->findResult('ocasiao', $id);

        if ($ocasioes === null) {

            return response()->json(['error' => 'A ocasião que procura não existe'], 404);
        }

        return response()->json($ocasioes, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ocasiao $ocasiao)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ocasioes = $this->ocasiao->find($id);

        if ($ocasioes === null) {
            return response()->json(['error' => 'A ocasião que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($ocasioes->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $ocasioes->feedback());
        } else {
            $request->validate($ocasioes->rules(), $ocasioes->feedback());
        }

        $ocasioes->update($request->all());

        return response()->json(['msg'=>'Ocasião atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ocasioes = $this->ocasiao->find($id);

        if ($ocasioes === null) {
            return response()->json(['error' => 'A ocasião que pretende eliminar não existe'], 404);
        }

        $ocasioes->delete();

        return response()->json(['msg'=>'Ocasião eliminado com sucesso'], 200);
    }
}
