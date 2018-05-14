<?php

namespace Tests\Feature;

use App\User;
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

        $userTest = User::where( 'email', 'puerfo@gmail.com' )->first();

        if($userTest !=null){
            $userTest->delete();
        }

        $user=[

            'nickname' => 'puerkito',
            'name' => 'pueroko',
            'last_name' => 'fulanito',
            'birth_date' => '1985/01/11',
            'email' => 'puerfo@gmail.com',
            'password' => bcrypt('cosmo'),
            'keycode' =>  hash("sha512",random_bytes(5) .'puerko')

        ];

        User::create($user);
        dd($user);
    }
}
