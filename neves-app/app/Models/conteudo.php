<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conteudo extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['titulo', 'descricao', 'media', 'posicao'];

    //Rules for validate inputs
    public function rules(){
        return [
            'titulo' => 'required',
            'descricao' => 'required',
            'media' => 'mimes:jpg,bmp,png,jpeg,mp4,avi,mpeg',
            'posicao' => 'required',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'mimes' => 'O ficheiro que carregou não tem um formato aceitável',
        ];
    }
}
