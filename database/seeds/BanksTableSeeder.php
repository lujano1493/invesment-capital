<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('banks')->truncate();
      DB::table('banks')->insert( [
        [ 'id' =>1, 'name' => 'Bancomer'] ,
        [ 'id'=> 2, 'name'=>'Santander'],
        [ 'id'=> 3,'name' => 'Banamex']
      ]
      );
    }
}
