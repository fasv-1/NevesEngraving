<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_favorites extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['user_id', 'produto_id'];

    //Table name different from that expected by laravel
    protected $table = 'user_favorites';

    //Rules for validate inputs
    public function rules(){
        return [
            'user_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
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
