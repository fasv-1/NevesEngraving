<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ocasiao extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['nome', 'estado'];
    //Table name different from that expected by laravel
    protected $table = 'ocasioes';

    //Rules for validate inputs
    public function rules(){
        return [
            'nome' => 'required|unique:ocasioes',
            'estado' => 'required|numeric'
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'nome.required' => 'O campo ocasião é obrigatório',
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Esta ocasião já existe',
            'numeric' => 'Este campo deve ser preenchido por um valor numérico'
        ];
    }

    //Table foreign relations
    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
