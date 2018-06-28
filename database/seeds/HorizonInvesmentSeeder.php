<?php

use Illuminate\Database\Seeder;

class HorizonInvesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('horizon_invesments')->truncate();
      DB::table('horizon_invesments')->insert( [
          ['id' =>1,  'name' => 'Corto Plazo'] ,
          ['id' =>2, 'name'=>'Mediano Plazo'],
          ['id' =>3, 'name' =>'Largo Plazo']

        ]);

    }
}
