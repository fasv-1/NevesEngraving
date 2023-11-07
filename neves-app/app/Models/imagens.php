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
            'required' => 'o campo :attribute é obrigatório',
            'image' => 'o ficheiro que carregou não é uma imagem'
        ];
    }
}
