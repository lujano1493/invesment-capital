<?php

use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('contracts') ->where('id',1)->delete();

      $dt = \Carbon\Carbon::now();
      $dateNow = $dt->toDateTimeString();


      DB::table('contracts')->insert(
        [
          'id' => 1,
          'id_user' => 3,
          'desc' => 'Cosmo Fulano',
          'id_horizon_invesment' => 2,
          'id_type_objective' => 1,
          'id_profile_invesment' => 1,
          'created_at' =>  $dateNow,
          'updated_at' =>$dateNow
         ]
       );

       DB::table('representants') ->where('id_contract' ,1) ->delete();

       DB::table('representants') ->insert([
         [
            'id' => 1,
            'id_contract' =>1,
            'id_type_representant' => 1,
            'name' =>'cosmo',
            'last_name' => 'fulano',
            'last_second_name' =>'sutano',
            'rfc' =>'FAEL081190'
         ],
        [
          'id' => 2,
          'id_contract' =>1,
          'id_type_representant' => 3,
          'name' =>'cosmo',
          'last_name' => 'fulano',
          'last_second_name' =>'sutano',
          'rfc' =>'FAEL081190'

        ]

       ]);


      DB::table('address_representants') ->where('id_contract' ,1) ->delete();

      DB::table('address_representants') ->insert([
        [
           'id' => 1,
           'id_contract' =>1,
           'id_representant' =>1,
           'cp' => '57500',
           'street' =>'sutano',
           'noExt' =>'13',
           'noInt' =>null
        ],
       [
         'id' => 2,
         'id_contract' =>1,
         'id_representant' =>2,
         'cp' => '57500',
         'street' =>'calle prueba',
         'noInt' =>'123',
         'noExt' =>'44'


       ]

      ]);




    }
}
