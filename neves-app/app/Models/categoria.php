<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function rules(){
        return [
            'nome' => 'required|unique:categorias'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'nome.unique' => 'esta categoria já existe'
        ];
    }
}
