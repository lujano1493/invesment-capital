<?php

use Illuminate\Database\Seeder;

class StatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('status_transactions')->truncate();
            DB::table('status_transactions')->insert( [
              [ 'id' =>1 ,'name' => 'Pendiente'] ,
              [ 'id' =>2 ,'name' => 'Realizado' ] ,

            ]);
    }
}
