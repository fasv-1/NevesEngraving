<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desconto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'desconto', 'ativo'];

    public function rules(){
        return [
            'nome' => 'required|unique:descontos,nome,'.$this->id.'|min:1',
            'descricao' => 'required',
            'desconto' => 'required|decimal:2|min:0|max:1',
            'ativo' => 'required'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Este desconto já existe',
            'decimal' => 'O valor do desconto deve ser decimal (dividido por 100) e com 2 casas decimais',
            'max' => 'O valor máximo é 1',
            'min' => 'O valor minimo é 0'
        ];
    }

    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
