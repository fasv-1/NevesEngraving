<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'meta-nome', 'quantidade', 'descricao', 'valor', 'costumizavel','categoria_id', 'materia_prima_id', 'desconto_id'];

    public function rules(){
        return [
            'nome' => 'required|unique:produtos,nome,'.$this->id.'|min:1',
            'meta-nome' => 'required',
            'quantidade' => 'required|numeric',
            'descricao' => 'required',
            'valor' => 'required|decimal:2|min:0',
            'costumizavel' => 'required',
            'categoria_id' => 'required',
            'materia_prima_id' => 'required',
            'desconto_id' => 'required',
        ];
    }
    
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O a quantidade do produto deve ser um valor numerico',
            'nome.unique' => 'Este produto já existe',
            'min' => 'O valor minimo é 0',
            'decimal' => 'O valor deve ser um numero com 2 casas decimais (4.00 , 5.56, 200.57) e deve conter um ponto em vez de virgula '
        ];
    }

    public function desconto() {
        return $this->hasOne('App\Models\Desconto');
    }
    public function categoria() {
        return $this->hasOne('App\Models\categoria');
    }
    public function materiaPrima() {
        return $this->hasOne('App\Models\materia_prima');
    }
}
