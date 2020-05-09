<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteRepresentateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estudiantes_representantes')->insertOrIgnore([
          []
        ]);
    }
}
