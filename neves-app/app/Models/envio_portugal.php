<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envio_portugal extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = ['peso', 'valor'];

    //Table name different from that expected by laravel
    protected $table = 'envio_portugal';

    //Rules for validate inputs
    public function rules(){
        return [
            'peso' => 'numeric',
            'valor' => 'decimal:2|min:0',
        ];
    }
    
    //Personalized validation responses
    public function feedback(){
        return [
            'numeric' => 'Este campo so aceita números',
            'decimal' => 'O este valor deve ter duas casas decimais',
        ];
    }
}
