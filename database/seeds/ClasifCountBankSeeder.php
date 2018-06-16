<?php

use Illuminate\Database\Seeder;

class ClasifCountBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('clasif_count_bank')->truncate();
      DB::table('clasif_count_bank')->insert( [
        ['id' => 1,'name' => 'Cheque'] ,
        ['id' => 2,'name'=>'Débito'] ,
        ['id' =>3, 'name'=>'CLABE'] ]

      );
    }
}
