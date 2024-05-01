<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;

    //Table name different from that expected by laravel
    protected $table = 'mensagens';

    //The attributes that are mass assignable.
    protected $fillable = ['nome', 'apelido', 'email', 'mensagem'];

    //Rules for validate inputs
    public function rules(){
        return[
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'mensagem' => 'required',
        ];
    }

    //Personalized validation responses
    public function feedback() {
        return[
            'required' => 'Este campo tem que ser preenchido',
        ];
    }
}
