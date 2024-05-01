<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Produto extends Model
{
    use HasFactory;

    //Table name different from that expected by laravel
    protected $table = 'pedido_produtos';

    //Rules for validate inputs
    public function rules()
    {
        return [
            'quantidade' => 'required',
            'cor' => 'nullable',
            'texto' => 'nullable',
            'produto_id' => 'required|exists:produtos,id',
            'pedido_id' => 'required|exists:pedido_detalhes,id',
        ];
    }

    //Personalized validation responses
    public function feedback()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'produto_id.exists' => 'Este produto não existe',
            'pedido_id.exists' => 'Este pedido não existe',
        ];
    }
}
