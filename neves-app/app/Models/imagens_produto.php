<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagens_produto extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['nome', 'posicao', 'produto_id'];

    //Rules for validate inputs
    public function rules(){
        return[
            'nome' => 'required|image|max:2048',
            'posicao' => 'required',
            'produto_id' => 'required'
        ];
    }

    //Personalized validation responses
    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'nome.required' => 'É obrigatório introduzir uma imagem',
            'nome.max' => 'A imagem que carregou é demasiado grande',
            'image' => 'O ficheiro que carregou não é uma imagem',
            
        ];
    }

    //Table foreign relations
    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
}
