<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;
    protected $fillable = ['descricao', 'produto_id'];

    public function rules(){
        return [
            'descricao' => 'required',
            'produto_id' => 'required'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'Este campo é obrigatório',
        ];
    }

    public function produto() {
        return $this->belongsTo('App\Models\Produto');
    }
}
