<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagens_produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'produto_id'];

    public function rules(){
        return[
            'nome' => 'required|unique:imagens_produtos,nome,'.$this->id.'|min:1',
            'produto_id' => 'required'
        ];
    }

    public function feedback(){
        return[
            'required' => 'o campo :attribute é obrigatório',
            'nome.unique' => 'esta imagem já existe',
        ];
    }
}
