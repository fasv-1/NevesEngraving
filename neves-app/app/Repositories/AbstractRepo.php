<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model; // permite tipar um elemento como sendo da class Model
use Illuminate\Support\Facades\Cache;

abstract class AbstractRepo
{
  public function __construct(Model $model)
  {

    $this->model = $model;
  }

  public function relatedRegists($atributos)
  {

    $this->model = $this->model->with($atributos);
    //a query está a ser montada

  }

  public function filter($filtros)
  {

    $filtros = explode(';', $filtros);

    foreach ($filtros as $key => $condicao) {

      $c = explode(':', $condicao);
      $this->model = $this->model->where($c[0], $c[1], $c[2],);
    }
  }

  public function interval($intervalo)
  {
    $values = explode(':', $intervalo);
    $this->model = $this->model->whereBetween($values[0], [$values[1], $values[2]]);
  }

  public function order($ordem)
  {
    $values = explode(':', $ordem);
    $this->model = $this->model->orderBy($values[0], $values[1]);
  }

  public function atributes($atributos)
  {
    $this->model = $this->model->selectRaw($atributos);
  }

  public function deleted()
  {
    $this->model = $this->model->onlyTrashed();
  }

  public function getResult($name)
  {
    $result = Cache::remember($name, 15, function () {
      return $this->model->get();
    });

    return $result;
  }

  public function findResult($name, $id)
  {
    if (Cache::has("$name$id")) {
      $result = Cache::get("$name$id");
    } else {
      $result = $this->model->find($id);
      Cache::put("$name$id", $result, 15);
    }

    return $result;
  }

  public function getPaginatedResult($name, $numeroDePaginas)
  {
    if (Cache::has("$name $numeroDePaginas")) {
      $result = Cache::get("$name $numeroDePaginas");
    } else {
      $result = $this->model->paginate($numeroDePaginas);
      Cache::put("$name $numeroDePaginas", $result, 15);
    }
    return $result;
  }
}

// $conteudo = [];

//Criar um dado dentro da bd Redis
// Cache::put('conteudo', 'conteudo pertendido', 10);
// chave, valor, tempo em segundos para expirar o dado em memória

//Recuperar dados da memória Redis
// $conteudo = Cache::get('conteudo');

//verifica se tem a chave pedida e se não tiver, introduz no banco

// 1ª possibilidade
// if(Cache::has('conteudo_total')) {
//     $conteudo = Cache::get('conteudo_total');
// } else {
//     $conteudo = $this->conteudo->all();
//     Cache::put('conteudo_total', $conteudo, 15);
// }

// 2ª possibilidade
// $conteudo = Cache::remember('conteudo_total', 15, function(){
//     return $this->conteudo->all();
// });
