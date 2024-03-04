<?php

namespace App\Http\Controllers;

use App\Models\User_details;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function __construct(User_details $user_details)
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->user_details = $user_details;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_details = $this->user_details->with('user')->get();

        return response()->json($user_details, 200);
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
        $request->validate($this->user_details->rules(), $this->user_details->feedback());

        $this->user_details->create($request->all());

        return response()->json(['msg'=>'Destalhes de usuário adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user_details = $this->user_details->with('user')->find($id);

        return response()->json($user_details, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_details $user_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user_details = $this->user_details->find($id);

        if ($user_details === null) {
            return response()->json(['error' => 'Os detalhes de usuário que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($user_details->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $user_details->feedback());
        } else {
            $request->validate($user_details->rules(), $user_details->feedback());
        }

        $user_details->update($request->all());

        return response()->json(['msg'=>'Detalhes de usuário atualizados com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_details = $this->user_details->find($id);

        if ($user_details === null) {
            return response()->json(['error' => 'Os detalhes de usuário que pretende eliminar não existe'], 404);
        }

        $user_details->delete();

        return response()->json(['msg'=>'Detalhes de usuário eliminados com sucesso'], 200);
    }
}
