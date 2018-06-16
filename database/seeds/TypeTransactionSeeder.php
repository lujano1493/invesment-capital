<?php

use Illuminate\Database\Seeder;

class TypeTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type_transaction')->truncate();
    DB::table('type_transaction')->insert( [
      ['id' =>1, 'name' => 'Depósito'] ,
      ['id' =>2, 'name'=>'Retiro'] ]);
    }
}
