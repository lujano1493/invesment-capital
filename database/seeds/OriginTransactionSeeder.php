<?php

use Illuminate\Database\Seeder;

class OriginTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('origin_transaction')->truncate();
      DB::table('origin_transaction')->insert( [
          ['id' =>1,  'name' => 'Deposito Bancario'] ,
          ['id' =>2, 'name'=>'Transferencia Bancaria'] ]);
    }
}
