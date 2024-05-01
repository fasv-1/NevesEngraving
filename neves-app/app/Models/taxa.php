<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxa extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['nome', 'valor'];

    //Rules for validate inputs
    public function rules(){
        return [
            'nome' => 'required|unique:taxas,nome,'.$this->id.'',
            'valor' => 'required|decimal:2|min:0',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Esta taxa já existe',
            'decimal' => 'O este valor deve ter duas casas decimais',
        ];
    }
}
