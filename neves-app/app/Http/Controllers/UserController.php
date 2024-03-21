<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
{
    // $this->middleware(['role:User|Admin']);
}
    public function index(){
        $users = User::with('roles')->get();

        return  response()->json(array('users' => $users));
    }


    public function update(Request $request, $id){

        $regras = [
            'role' =>  'required|exists:roles,name',
            'role_delete' =>  'required|exists:roles,name'
        ];
        $feedback = [
            'required' => 'Este campo é obrigatório',
            'exists' => 'Este role não existe'
        ];

        $request->validate($regras, $feedback);

        $user = User::find($id);

        $user->removeRole($request->input('role_delete'));

        $user->assignRole($request->input('role'));

        return  response()->json(array('msg' => 'Role adicionado com sucesso'));
    }

    public function destroy($id){

        $user = User::find($id);

        if ($user === null) {
            return response()->json(['error' => 'O user que pretende eliminar não existe'], 404);
        }

        $user->delete();

        return response()->json(['msg' => 'O user foi eliminado com sucesso'], 200);
    }
}
