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

      DB::table('users')->insert([
            'nickname' => 'admin',
            'name' => 'fercho',
            'last_name' => 'Administrador',
            'birth_date' => '1988/08/07',
            'email' => 'lujano14.93@gmail.com',
            'password' => bcrypt('fer123'),
            'status'=> 1,
            'role_id' => 0,
            'keycode' =>  hash("sha512",random_bytes(5) .'admin')
      ]
      
    );

      DB::table('users')->insert(
      [
            'nickname' => 'manso1',
            'name' => 'cosmo',
            'last_name' => 'fulanito',
            'birth_date' => '1965/11/21',
            'email' => 'fulanocosmo@gmail.com',
            'password' => bcrypt('cosmo'),
            'status'=> 0,
            'role_id' => 1,
            'keycode' =>  hash("sha512",random_bytes(5) .'cosmo')
      ]

      );

  }
}