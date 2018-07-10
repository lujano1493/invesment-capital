<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
        DB::table('modules')->insert([
            [ 'id' =>1, 'name'=>'Investment' ,'route' => 'capital.invesment','icon' =>'fa fa-bar-chart-o fa-fw','ident' =>'investment' ],
            [ 'id' =>2, 'name'=>'Educación Financiera', 'route' =>'capital.educacion' ,'icon' => 'fa fa-edit fa-fw' ,'ident' =>'educacion'  ]  ]);
    }
}
