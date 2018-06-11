<?php

use Illuminate\Database\Seeder;

class StatusUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('status_user')->truncate();
          DB::table('status_user')->insert( [
              ['id' => 1 ,'name' => 'Activo'] ,
              [ 'id' => 0, 'name'=>'Inactivo'],
              ['id' => -1 ,'name' => 'Bloqueado']
            ]);
    }
}
