<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envio_europa extends Model
{
    use HasFactory;

    protected $fillable = ['peso', 'valor'];
    protected $table = 'envio_europa';

    public function rules(){
        return [
            'peso' => 'numeric',
            'valor' => 'decimal:2|min:0',
        ];
    }
    
    public function feedback(){
        return [
            'numeric' => 'Este campo so aceita números',
            'decimal' => 'O este valor deve ter duas casas decimais',
        ];
    }
}
