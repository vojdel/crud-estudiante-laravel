<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  public function estado(){
    return $this->belongTo(Estado::class);
  }
}