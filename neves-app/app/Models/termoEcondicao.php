<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class termoEcondicao extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao'];

    public function rules(){
        return [
            'titulo' => 'required|unique:termo_econdicaos,titulo,'.$this->id.'',
            'descricao' => 'required',
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'titulo.unique' => 'Este termo/condição já existe',
        ];
    }
}
