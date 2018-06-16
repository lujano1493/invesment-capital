<?php

use Illuminate\Database\Seeder;

class ExtensionDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('extension_document')->truncate();
    DB::table('extension_document')->insert( [
      [ 'id' =>1 ,'name' => 'image/png' ,'type' =>'imagen png' ] ,
      [ 'id' =>2 ,'name'=>'document/pdf', 'type' => 'documento pdf']

    ]);
    }
}
