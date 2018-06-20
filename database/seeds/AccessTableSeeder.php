<?php

use Illuminate\Database\Seeder;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('access')->truncate();
      $dt = \Carbon\Carbon::now();
      $dateNow = $dt->toDateTimeString();
      DB::table('access')->insert( [
        [ 'id' =>1, 'id_user' => '1', 'id_module' => 1, 'date_expired' => $dateNow]
        ]
      );
    }
}
