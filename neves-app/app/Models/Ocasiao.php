<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ocasiao extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'estado'];
    protected $table = 'ocasioes';

    public function rules(){
        return [
            'nome' => 'required|unique:ocasioes',
            'estado' => 'required|numeric'
        ];
    }
    
    public function feedback(){
        return [
            'nome.required' => 'O campo ocasião é obrigatório',
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Esta ocasião já existe',
            'numeric' => 'Este campo deve ser preenchido por um valor numérico'
        ];
    }

    public function produto() {
        return $this->hasMany('App\Models\Produto');
    }
}
