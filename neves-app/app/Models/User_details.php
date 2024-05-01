<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_details extends Model
{
    use HasFactory;
    
    //The attributes that are mass assignable.
    protected $fillable = ['user_id', 'morada1', 'morada2', 'cidade', 'codigo_postal', 'pais', 'telemovel'];
    
    //Table name different from that expected by laravel
    protected $table = 'user_details';

    //Rules for validate inputs
    public function rules(){
        return [
            'user_id' => 'required|unique:user_details,user_id|exists:users,id',
            'morada1' => 'required|unique:user_details,morada1,'.$this->id ,
            'morada2' => 'max:100|nullable',
            'cidade' => 'required|max:60',
            'codigo_postal' => 'required|max:12',
            'pais' => 'required|max:60',
            'telemovel' => 'numeric|unique:user_details,telemovel',
        ];
    }
    
     //Personalized validation responses
    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'Este campo só aceita valores numéricos',
            'morada1.unique' => 'Esta morada já existe',
            'telemovel.unique' => 'Este numero de telemóvel já está a ser usado',
            'max' => 'O valor inserido é demasiado extenso',
            'exists' => 'O valor introduzido não existe na tabela de origem',
        ];
    }

    //Table foreign relations
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
