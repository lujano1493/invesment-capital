<?php

use Illuminate\Database\Seeder;

class ProfileInvesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('profile_invesment')->truncate();
    DB::table('profile_invesment')->insert( [
        [ 'id' =>1, 'name' => 'Moderado'] ,
        [ 'id' =>2, 'name'=>'Agresivo'],
        [ 'id' =>3,'name' =>'Especulativo' ]

      ]);
    }
}
