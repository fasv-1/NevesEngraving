<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;
    protected $table = 'mensagens';
    protected $fillable = ['nome', 'apelido', 'email', 'mensagem'];

    public function rules(){
        return[
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'mensagem' => 'required',
        ];
    }

    public function feedback() {
        return[
            'required' => 'Este campo tem que ser preenchido',
        ];
    }
}
