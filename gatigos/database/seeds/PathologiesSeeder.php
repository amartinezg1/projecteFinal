<?php

use Illuminate\Database\Seeder;

class PathologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('pathologies')->insert([
      'name' => 'rabia',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'leishmaniosis',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'moquillo',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'rotura ósea',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'úlcera',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'diabetes',
      ]);
    DB::table('pathologies')->insert([
      'name' => 'hepatitis',
      ]);
    }
}
