<?php

use Illuminate\Database\Seeder;

class TypeObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type_objectives')->truncate();
      DB::table('type_objectives')->insert( [
        ['id' =>1,  'name' => 'Negocio'] ,
        ['id' =>2,  'name' => 'Auto'] ,
        ['id' =>3,  'name' => 'Educación'] ,
        ['id' =>4, 'name'=>'Retiro'] ,
        ['id' =>5, 'name'=>'Viaje'] 
      ]
      );
    }
}
