<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testViewUser()
    {
      $user = factory(App\User::class, 'reg')->create();
      $path = '/user/'.$user->id;

      $this->actingAs($user)
           ->visit($path)
           ->see('User information');
    }
}
