<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representantes extends Model
{
  public function persona(){
    return $this->belongTo(Persona::class);
  }

  public function telefono(){
    return $this->belongTo(Telefono::class);
  }
}
