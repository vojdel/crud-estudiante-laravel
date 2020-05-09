<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('estudiantes')->insertOrIgnore([
        ['id' => 1, 'id_persona' => 1, 'id_users' => 1],
        ['id' => 2, 'id_persona' => 2, 'id_users' => 1],
        ['id' => 3, 'id_persona' => 3, 'id_users' => 1],
        ['id' => 4, 'id_persona' => 4, 'id_users' => 1],
        ['id' => 5, 'id_persona' => 5, 'id_users' => 1],
      ]);
    }
}
