<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;
    //The attributes that are mass assignable.
    protected $fillable = ['descricao', 'cor', 'extras', 'produto_id'];

    //Rules for validate inputs
    public function rules(){
        return [
            'produto_id' => 'required'
        ];
    }

    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'Este campo é obrigatório',
        ];
    }

    //Table foreign relations
    public function produto() {
        return $this->belongsTo('App\Models\Produto');
    }
}
