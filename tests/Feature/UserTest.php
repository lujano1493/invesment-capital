<?php

namespace Tests\Feature;

use App\Model\Access;
use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->assertTrue(true);


       $modules= User::find(2)->modules;




     //  $user= User::find(2);

       //$user->modules()->attach([2 => ['date_expired'=> '2019-10-10']]);
       //$user->modules()->attach(2, ['date_expired'=> '2018-08-10']);
       //$user->modules()->detach(2);
       $modules = User::find(52)->modules()->wherePivot('id_module',2)->get();
       dd($modules);
        foreach ($modules as $module)
            var_dump($module->access->id);

    }
}
