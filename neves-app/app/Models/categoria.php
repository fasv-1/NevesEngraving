<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function rules(){
        return [
            'nome' => 'required|unique:categorias'
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo categoria é obrigatório',
            'nome.unique' => 'Esta categoria já existe'
        ];
    }

    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
