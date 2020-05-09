<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // para encryptar
use Illuminate\Support\Str; // para random
use Carbon\Carbon; // para las fechas

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('personas')->insertOrIgnore([
        ['id' => 1, 'nombres' => 'Jose Daniel', 'apellidos' => 'Vasquez Pineda', 'genero' => 'hombre', 'fechaDeNacimiento' => '1999-06-09', 'id_direccion' => 1],
        ['id' => 2, 'nombres' => 'Miguel Alejandro', 'apellidos' => 'Gizzi Romero', 'genero' =>  'hombre', 'fechaDeNacimiento' => Carbon::now(), 'id_direccion' => 2],
        ['id' => 3, 'nombres' => 'Maria '.Str::random(6), 'apellidos' => Str::random(8).' '.Str::random(8), 'genero' => 'mujer', 'fechaDeNacimiento' => Carbon::now(), 'id_direccion' => 3],
        ['id' => 4, 'nombres' => 'Christian '.Str::random(6), 'apellidos' => 'Gimenez '.Str::random(8), 'genero' =>  'hombre', 'fechaDeNacimiento' => Carbon::now(), 'id_direccion' => 4],
        ['id' => 5, 'nombres' => 'Walter '.Str::random(6), 'apellidos' => 'Caro '.Str::random(8), 'genero' =>  'hombre', 'fechaDeNacimiento' => Carbon::now(), 'id_direccion' => 5]
      ]);
    }
}
