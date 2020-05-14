<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public function persona(){
      return $this->belongTo(Persona::class);
    }

    public function direccion(){
      return $this->belongTo(Direccion::class);
    }
}
