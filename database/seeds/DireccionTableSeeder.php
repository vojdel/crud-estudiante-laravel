<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('direccions')->insertOrIgnore([
        ['id' => 1, 'id_parroquia' => 992, 'direccion' => 'en mi casa'],
        ['id' => 2, 'id_parroquia' => 991, 'direccion' => ''.Str::random(10)],
        ['id' => 3, 'id_parroquia' => 991, 'direccion' => ''.Str::random(10)],
        ['id' => 4, 'id_parroquia' => 991, 'direccion' => ''.Str::random(10)],
        ['id' => 5, 'id_parroquia' => 991, 'direccion' => ''.Str::random(10)]
      ]);
    }
}
