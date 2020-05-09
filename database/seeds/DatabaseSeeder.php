<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          UsersTableSeeder::class,
          EstadoTableSeeder::class,
          MunicipioTableSeeder::class,
          ParroquiaTableSeeder::class,
          DireccionTableSeeder::class,
          PersonaTableSeeder::class,
          EstudianteTableSeeder::class,
          TelefonoTableSeeder::class,
          RepresentanteTableSeeder::class,
          EstudianteRepresentateTableSeeder::class
        ]);
    }
}
