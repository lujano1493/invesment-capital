<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           UsersTableSeeder::class,
           ModulesTableSeeder::class,
           RolesTableSeeder::class,
           AccessTableSeeder::class,
           StatusUserTableSeeder::class


           ] );
      //  $this->call(UsersFackeSeeder::class);
    }
}
