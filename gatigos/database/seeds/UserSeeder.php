<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
    	
     	
	DB::table('users')->insert([
      'name' => 'Àngel',
      'surname1' => 'Martínez',
      'surname2' => 'Guallar',
      'dni' => '41006089x',
      'email' => 'amguallarad@gmail.com',
      'address' => 'calle falsa 123',
      'zip_code' => '08018',
      'phone1' => '654432345',
      'phone2' => '965389566',
      'password' => bcrypt('abogado1234'),
      'active' => true,
      'user_role' => 'admin'
      ]);
      DB::table('users')->insert([
        'name' => 'Daniel',
        'surname1' => 'Gallego',
        'surname2' => 'Fernandez',
        'dni' => '77749545T',
        'email' => 'daniel@gmail.com',
        'address' => 'calle falsa 123',
        'zip_code' => '08640',
        'phone1' => '651983297',
        'phone2' => '987451236',
        'password' => bcrypt('abogado1234'),
        'active' => false,
        'user_role' => 'veterinario'
        ]);
        DB::table('users')->insert([
          'name' => 'Ana',
          'surname1' => 'Bohuele',
          'surname2' => 'Fernandez',
          'dni' => '12345678S',
          'email' => 'ana_bohuele@gmail.com',
          'address' => 'calle falsa 123',
          'zip_code' => '08640',
          'phone1' => '651983297',
          'phone2' => '987451236',
          'password' => bcrypt('abogado1234'),
          'active' => true,
          'user_role' => 'recepcionista'
          ]);
    }
}
