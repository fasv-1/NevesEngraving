<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Messages;
use App\Repositories\MensagemRepo;

class MensagemController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct(Mensagem $Mensagem)
    {
        $this->mensagem = $Mensagem;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mensagemRepo = new MensagemRepo($this->mensagem);

        if ($request->has('filtro')) {

            $mensagemRepo->filter($request->filtro);

            $mensagem = $mensagemRepo->getResult($request->filtro);
        } else {
            $mensagem = $mensagemRepo->getResult('allMensages');
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
        $mensagemRepo = new MensagemRepo($this->mensagem);

        $mensagem = $mensagemRepo->findResult('mensagem', $id);

        if ($mensagem === null) {

            return response()->json(['error' => 'A mensagem que procura não existe'], 404);
        }

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
