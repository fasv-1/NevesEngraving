<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class categoria extends Model
{
    use HasFactory;
    //The attributes that are mass assignable.
    protected $fillable = ['nome'];

    //Rules for validate inputs
    public function rules(){
        return [
            'nome' => 'required|unique:categorias'
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo categoria é obrigatório',
            'nome.unique' => 'Esta categoria já existe'
        ];
    }

    //Table foreign relations
    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
