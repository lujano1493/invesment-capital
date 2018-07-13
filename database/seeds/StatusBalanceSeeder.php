<?php

use Illuminate\Database\Seeder;

class StatusBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('status_balances')->truncate();
      DB::table('status_balances')->insert( [
        [ 'id' =>1 ,'name' => 'Activo' ] ,
        [ 'id' =>2 ,'name' => 'Inactivo'] 
      ]);
    }
}
