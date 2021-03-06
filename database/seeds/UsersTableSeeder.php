<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: fercho14.93
 * Date: 29/04/18
 * Time: 20:40
 */

class UsersTableSeeder extends Seeder
{

  public function run(){
      DB::table('users')->truncate();

      DB::table('users')->insert([[
            'id' => 1,
            'nickname' => 'fernando14.93',
            'name' => 'fercho',
            'last_name' => 'Administrador',
            'birth_date' => '1988/08/07',
            'email' => 'lujano14.93@gmail.com',
            'password' => bcrypt('fer123'),
            'status'=> 1,
            'id_role' => 1,
            'keycode' =>  hash("sha512",random_bytes(5) .'admin')
      ],


      [
            'id' => 2,
            'nickname' => 'JorgeOperacion',
            'name' => 'Jorge Ernesto',
            'last_name' => 'García Salgado',
            'birth_date' => '1991/05/01',
            'email' => 'jegs_9@live.com',
            'password' => bcrypt('jorge123'),
            'status'=> 1,
            'id_role' => 1,
            'keycode' =>  hash("sha512",random_bytes(5) .'admin')
      ],

          [
              'id' => 3,
              'nickname' => 'manso1',
              'name' => 'cosmo',
              'last_name' => 'fulanito',
              'birth_date' => '1965/11/21',
              'email' => 'fulanocosmo@gmail.com',
              'password' => bcrypt('cosmo'),
              'status'=> 1,
              'id_role' => 2,
              'keycode' =>  hash("sha512",random_bytes(5) .'cosmo')
          ]

          ]);


      $faker = Faker\Factory::create();
      foreach (range(1, 1) as $index) {

          $dateCreated=$faker->dateTimeBetween('-5 years' , 'now');
          DB::table('users')->insert([
              'name' => $faker->name,
              'email' => $faker->email,
              'last_name' => $faker->lastName,
              'birth_date' =>$faker->dateTimeBetween('-68 years' , ' -18 years'),
              'nickname' =>$faker->userName,
              'status' => 1,
              'id_role' => 2,
              'password' => bcrypt('secret'),
              'keycode' => hash("sha512", random_bytes(5) . 'admin'),
              'created_at' =>$dateCreated,
              'updated_at' =>$dateCreated
          ]);


      }



  }
}
