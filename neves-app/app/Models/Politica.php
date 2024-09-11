<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Politica extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'subtitulo', 'texto', 'politica', 'ref_titulo'];

    public function rules(){
        return [
            'titulo' => 'string|nullable',
            'subtitulo' => 'string|nullable',
            'texto' => 'required',
            'politica' => 'required',
            'ref_titulo' => 'required',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }
}
