<?php

namespace App\Http\Controllers;

use App\Models\User_reviews;
use Illuminate\Http\Request;

class UserReviewsController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct(User_reviews $user_reviews) 
    {
        // $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->user_reviews = $user_reviews;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_reviews = $this->user_reviews->with('user')->with('produto')->get();

        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $user_reviews = $user_reviews->where($conditions[0], $conditions[1], $conditions[2]);

            if (isset($conditions[3])) {
                $user_reviews = $user_reviews->where($conditions[0], $conditions[1], $conditions[2])->where($conditions[3], $conditions[4], $conditions[5]);
            }
        } else {
            $user_reviews = $user_reviews;
        }

        return response()->json(['review' => $user_reviews], 200);
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
        $request->validate($this->user_reviews->rules(), $this->user_reviews->feedback());

        $this->user_reviews->create($request->all());

        return response()->json(['msg'=>'Avaliações de usuário adicionado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user_reviews = $this->user_reviews->with('user')->with('produto')->find($id);

        return response()->json($user_reviews, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_reviews $user_reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user_reviews = $this->user_reviews->find($id);

        if ($user_reviews === null) {
            return response()->json(['error' => 'Avaliações de usuário que pretende atualizar não existe'], 404);
        }

        //makes separation of the methods
        if ($request->method() === 'PATCH') {
            $dinamycRules = [];

            //browse all rules for indentify the especific key and rule that as been recive, save them in the dinamycRules variable
            foreach ($user_reviews->rules() as $input => $rules) {
                if (array_key_exists($input, $request->all())) {
                    $dinamycRules[$input] = $rules;
                }
            }

            //validation with the dinamic rules
            $request->validate($dinamycRules, $user_reviews->feedback());
        } else {
            $request->validate($user_reviews->rules(), $user_reviews->feedback());
        }

        $user_reviews->update($request->all());

        return response()->json(['msg'=>'Avaliações de usuário atualizados com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_reviews = $this->user_reviews->find($id);

        if ($user_reviews === null) {
            return response()->json(['error' => 'Avaliações de usuário que pretende eliminar não existe'], 404);
        }

        $user_reviews->delete();

        return response()->json(['msg'=>'Avaliações de usuário eliminados com sucesso'], 200);
    }
}
