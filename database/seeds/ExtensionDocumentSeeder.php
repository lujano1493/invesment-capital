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
      [ 'id' =>1 ,'extension' => 'png','name' => 'image/png' ,'type' =>'imagen png' ] ,
      [ 'id' =>2 ,'extension' => 'jpeg','name' => 'image/jpeg' ,'type' =>'imagen jpeg' ] ,
      [ 'id' =>3 ,'extension' => 'jpg','name' => 'image/jpg' ,'type' =>'imagen jpg' ] ,
      [ 'id' =>4 ,'extension' => 'pdf','name'=>'application/pdf', 'type' => 'documento pdf']

    ]);
    }
}
