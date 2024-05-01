<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_reviews extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['comentario', 'like', 'rating', 'user_id', 'produto_id'];

    //Table name different from that expected by laravel
    protected $table = 'user_reviews';

    //Rules for validate inputs
    public function rules(){
        return [
            'comentario' => 'nullable',
            'like' => 'nullable|boolean',
            'rating' => 'nullable|numeric|max:5',
            'user_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'Este campo só aceita valores numéricos',
            'bollean' => 'Este campo so aceita valores boleanos',
            'max' => 'O valor inserido é demasiado extenso',
            'exists' => 'O valor introduzido não existe na tabela de origem',
        ];
    }

    //Table foreign relations
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function produto() {
        return $this->belongsTo('App\Models\Produto');
    }
}
