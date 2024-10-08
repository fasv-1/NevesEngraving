<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Repositories\ContactRepo;

class ContactoController extends Controller
{
    public function __construct(Contacto $contacto)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->contacto = $contacto;
        
        // $this->middleware(['role:User|Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contactoRepo = new ContactRepo($this->contacto);

        if ($request->has('filtro')) {

            $contactoRepo->filter($request->filtro);

            $contactos = $contactoRepo->getResult($request->filtro);
        } else {
            $contactos = $contactoRepo->getResult('allContacts');
        }

         return response()->json(['contacts' => $contactos ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->contacto->rules(), $this->contacto->feedback());

        $this->contacto->create($request->all());

        return response()->json(['msg' => 'Contacto adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contactoRepo = new ContactRepo($this->contacto);

        $contacto = $contactoRepo->findResult('contacto', $id);

        if ($contacto === null) {

            return response()->json(['error' => 'O conteudo que procura não existe'], 404);
        }

        // $contacto = $this->contacto->find($id);

        return response()->json($contacto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contactos = $this->contacto->find($id);

        if ($contactos === null) {
            return response()->json(['error' => 'O contacto que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($contactos->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $contactos->feedback());
        } else {
            $request->validate($contactos->rules(), $contactos->feedback());
        }

        $contactos->update($request->all());

        return response()->json(['msg' => 'Contacto atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contactos = $this->contacto->find($id);

        if ($contactos === null) {
            return response()->json(['error' => 'O contacto que pretende eliminar não existe'], 404);
        }

        $contactos->delete();

        return response()->json(['msg' => 'Contacto eliminado com sucesso'], 200);
    }
}
