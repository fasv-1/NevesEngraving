<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conteudo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'posicao'];

    public function rules(){
        return [
            'titulo' => 'required',
            'descricao' => 'required',
            'posicao' => 'required|unique:conteudos,posicao,'.$this->id.'',
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'posicao.unique' => 'Esta posicao já está ocupada',
        ];
    }
}
