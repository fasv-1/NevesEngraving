<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Detalhe extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'apelido', 'email', 'morada', 'cidade', 'codigo_postal', 'pais', 'telemovel', 'descricao', 'quant_total', 'total_pag'];
    protected $table = 'pedido_detalhes';

    protected $with = ['produtos'];

    public function rules()
    {
        return [
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'morada' => 'required',
            'cidade' => 'required|max:60',
            'codigo_postal' => 'required|max:12',
            'pais' => 'required|max:60',
            'telemovel' => 'nullable',
            'descricao' => 'nullable',
            'quant_total' => 'required',
            'total_pag' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'max' => 'O valor inserido é demasiado extenso',
        ];
    }

    public function produtos() {
        return $this->belongsToMany('App\Models\Produto', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('quantidade', 'texto', 'cor'); 
    }
}
