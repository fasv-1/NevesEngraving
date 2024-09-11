<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'contacto'];

    public function rules(){
        return [
            'nome' => 'required|unique:contactos',
            'contacto' => 'required'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Este contacto já existe'
        ];
    }
}
