<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagens_produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'posicao', 'produto_id'];

    public function rules(){
        return[
            'nome' => 'required|image',
            'posicao' => 'required',
            'produto_id' => 'required'
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'image' => 'O ficheiro que carregou não é uma imagem'
        ];
    }

    public function produtos(){
        return $this->hasMany('App\Models\Produto', 'produto_id','id');
    }
}
