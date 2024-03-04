<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_favorites extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produto_id'];
    protected $table = 'user_favorites';

    public function rules(){
        return [
            'user_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O valor introduzido não existe na tabela de origem',
        ];
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function produto() {
        return $this->belongsTo('App\Models\Produto');
    }
}
