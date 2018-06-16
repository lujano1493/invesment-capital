<?php

use Illuminate\Database\Seeder;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type_document')->truncate();
      DB::table('type_document')->insert( [
          ['id' =>1,'name' => 'Deposito Bancario'],
          ['id' =>2, 'name' => 'Cheque al Portador']

        ]);
    }
}
