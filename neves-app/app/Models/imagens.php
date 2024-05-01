<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagens extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['nome', 'utilidade', 'desconto_id'];
    
    //Table name different from that expected by laravel
    protected $table = 'imagens';

    //Rules for validate inputs
    public function rules()
    {
        return [
            'nome' => 'required|image',
            'utilidade' => 'required',
        ];
    }

    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'image' => 'O ficheiro que carregou não é uma imagem'
        ];
    }
}
