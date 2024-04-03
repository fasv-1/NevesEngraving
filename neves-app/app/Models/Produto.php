<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'meta_nome', 'quantidade', 'descricao', 'valor', 'costumizavel','ocasioes_id', 'categoria_id', 'materia_prima_id', 'desconto_id'];

    public function rules(){
        return [
            'nome' => 'required|unique:produtos,nome,'.$this->id.'|min:1',
            'meta_nome' => 'required',
            'quantidade' => 'required|numeric',
            'descricao' => 'required',
            'valor' => 'required|decimal:2|min:0',
            'costumizavel' => 'required',
            'ocasioes_id' => 'required',
            'categoria_id' => 'required',
            'materia_prima_id' => 'required',
            'desconto_id' => 'required',
        ];
    }
    
    public function feedback(){
        return [
            'categoria_id.required' => 'A categoria é obrigatória',
            'materia_prima_id.required' => 'A matéria-prima é obrigatório',
            'desconto_id.required' => 'O campo desconto é obrigatório',
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'A quantidade do produto deve ser um valor numerico',
            'nome.unique' => 'Este produto já existe',
            'min' => 'O valor minimo é 0',
            'decimal' => 'O valor deve ser um numero com 2 casas decimais (4.00 , 5.56, 200.57) e deve conter um ponto em vez de virgula '
        ];
    }

    public function desconto() {
        return $this->belongsTo('App\Models\Desconto');
    }
    public function materiaPrima() {
        return $this->belongsTo('App\Models\materia_prima');
    }
    public function ocasioes() {
        return $this->belongsTo('App\Models\Ocasiao');
    }
    public function categoria() {
        return $this->belongsTo('App\Models\categoria');
    }
    public function imagens() {
        return $this->hasMany('App\Models\imagens_produto');
    }
    public function userReviews() {
        return $this->hasMany('App\Models\User_reviews');
    }
    public function userFavorites() {
        return $this->hasMany('App\Models\User_favorites');
    }
    public function produtoDetalhes() {
        return $this->hasMany('App\Models\User_favorites');
    }

    public function pedidos() {
        return $this->belongsToMany('App\Models\Pedido_Detalhe', 'pedido_produtos', 'produto_id', 'pedido_id')->withPivot('created_at'); 
    }
}
