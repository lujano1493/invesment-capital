<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Contract;
class UserContractTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

      $usuarios =  User::find(3);

      $contract = $usuarios->contract;
      $representants= $contract->representants;

      foreach ($representants as $key => $representant) {
          $adress= $representant->adress;
          dd($adress);
      }




    }
}
