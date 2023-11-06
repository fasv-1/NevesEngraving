<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia_prima extends Model
{
    use HasFactory;
    protected $table = 'materia_prima';
    protected $fillable = ['nome'];

    public function rules(){
        return [
            'nome' => 'required|unique:materia_prima'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'nome.unique' => 'esta materia-prima já existe'
        ];
    }
}
