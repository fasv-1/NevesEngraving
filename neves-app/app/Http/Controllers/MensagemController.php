<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Messages;

class MensagemController extends Controller
{
    public function __construct(Mensagem $Mensagem)
    {
        $this->mensagem = $Mensagem;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mensagem = array();

        if ($request->has('filtro')) {
            $conditions = explode(':', $request->filtro);
            $mensagem = $this->mensagem->where($conditions[0], $conditions[1], $conditions[2])->get();

            if (isset($conditions[3])) {
                $mensagem = $this->mensagem->where($conditions[0], $conditions[1], $conditions[2])->where($conditions[3], $conditions[4], $conditions[5])->get();
            }
        } else {
            $mensagem = $this->mensagem->all();
        }
        
        return response()->json(['mensagem' => $mensagem], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->mensagem->rules(), $this->mensagem->feedback());

        $this->mensagem->create($request->all());

        $mensagem = $this->mensagem->all()->last();

        Mail::to(env('MAIL_FROM_ADDRESS', 'hello@example.com'))->send(new Messages($mensagem));

        return response()->json(['msg' => 'Mensagem enviada com sucesso'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mensagem = $this->mensagem->find($id);

        return response()->json(['mensagem' => $mensagem], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensagem $mensagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mensagem = $this->mensagem->find($id);

        if($mensagem == null){
            return response()->json(['msg' => 'Esta mensagem não existe']);
        }

        $mensagem->delete();

        return response()->json(['msg' => 'Mensagem eliminada com sucesso']);
    }
}
