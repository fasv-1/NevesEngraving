<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia_prima extends Model
{
    use HasFactory;
    //Table name different from that expected by laravel
    protected $table = 'materia_prima';

    //The attributes that are mass assignable.
    protected $fillable = ['nome'];

    //Rules for validate inputs
    public function rules(){
        return [
            'nome' => 'required|unique:materia_prima'
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo matéria-prima é obrigatório',
            'nome.unique' => 'Esta materia-prima já existe'
        ];
    }

    //Table foreign relations
    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
