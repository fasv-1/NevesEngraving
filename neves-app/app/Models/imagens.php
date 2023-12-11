<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagens extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'utilidade', 'desconto_id'];
    protected $table = 'imagens';

    public function rules()
    {
        return [
            'nome' => 'required|image',
            'utilidade' => 'required',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'image' => 'O ficheiro que carregou não é uma imagem'
        ];
    }
}
