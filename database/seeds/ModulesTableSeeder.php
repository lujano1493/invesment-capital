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
            [ 'name'=>'Invesment' ,'route' => 'capital.invesment','icon' =>'fa fa-bar-chart-o fa-fw','ident' =>'invesment' ],
            [ 'name'=>'Educación Financiera', 'route' =>'capital.educacion' ,'icon' => 'fa fa-edit fa-fw' ,'ident' =>'educacion'  ]  ]);
    }
}
