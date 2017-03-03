<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NemanjaTest extends TestCase
{
    use DatabaseTransactions;

    public function testLogin()
    {
       $this->visit('/login')
            ->type('stoja', 'username')
            ->type('asdfasdf', 'password')
            ->press('login')
            ->seePageIs('/')
            ->see('stoja');
    }

    public function testAddComment(){
      $user = factory(App\User::class, 'reg')->create();
      $event = App\Event::where('name', '=', 'Buducnost')->first();

      $this->actingAs($user)
           ->visit('/event/'.$event->id)
           ->type('This is a test comment','comment')
           ->press('addComment');
      $this->seeInDatabase('eventcomments', ['text' => 'This is a test comment']);
    }
}
