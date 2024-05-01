<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class termoEcondicao extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['titulo', 'descricao'];

    //Rules for validate inputs
    public function rules(){
        return [
            'titulo' => 'required|unique:termo_econdicaos,titulo,'.$this->id.'',
            'descricao' => 'required',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'titulo.unique' => 'Este termo/condição já existe',
        ];
    }
}
