<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $fillable = ['ocasiao', 'categoria', 'estado'];

    public function rules(){
        return [
            'ocasiao' => 'required',
            'categoria' => 'required',
            'estado' => 'required|int'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
