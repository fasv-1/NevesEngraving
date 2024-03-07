<?php

namespace App\Http\Controllers;

use App\Models\User_favorites;
use Illuminate\Http\Request;

class UserFavoritesController extends Controller
{
    public function index(Request $request){
        $userFavorites = User_favorites::with('user')->with('produto')->get();

        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $userFavorites = $userFavorites->where($conditions[0], $conditions[1], $conditions[2]);

            if (isset($conditions[3])) {
                $userFavorites = $userFavorites->where($conditions[0], $conditions[1], $conditions[2])->where($conditions[3], $conditions[4], $conditions[5]);
            }
        } else {
            $userFavorites = $userFavorites;
        }

        return response()->json(['favorites'=> $userFavorites], 200);
    }
    
    public function store(Request $request)
    {
        $userFavorites = new User_favorites();

        $request->validate($userFavorites->rules(), $userFavorites->feedback());

        $userFavorites->create($request->all());

        return response()->json(['msg' => 'Produto adicionado aos favoritos'], 201);
    }

    public function destroy($id)
    {
        $userFavorites = new User_favorites();

        $userFavorites = $userFavorites->find($id);

        if ($userFavorites === null) {
            return response()->json(['error' => 'O produto eliminar não existe'], 404);
        }

        $userFavorites->delete();

        return response()->json(['msg'=>'O produto selecionado foi eliminado dos favoritos'], 200);
    }
}
