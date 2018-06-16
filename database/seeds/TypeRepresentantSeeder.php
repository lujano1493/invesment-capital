<?php

use Illuminate\Database\Seeder;

class TypeRepresentantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type_representant')->truncate();
      DB::table('type_representant')->insert(
        [['id' =>1, 'name' => 'Titular'] ,
         ['id'=>2, 'name'=>'Cotitular'] ,
         ['id'=>3, 'name'=>'Beneficiario']
        ]);
    }
}
