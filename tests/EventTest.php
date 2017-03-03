<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
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

    public function testOpenForSignUp()
    {
      $user = factory(App\User::class, 'reg')->create();
      $event = App\Event::where('name', '=', 'Buducnost')->first();
      $old = $event->participantsApplied;

      $this->actingAs($user)
            ->call('GET', "/event/". $event->id ."/signup");
      $old++; $event = App\Event::where('name', '=', 'Buducnost')->first();
      $this->assertEquals($old, $event->participantsApplied, $message = '', $delta = 0);
    }

    public function textClosedForSignUp()
    {
      $user = factory(App\User::class, 'reg')->create();
      $event = App\Event::where('name', '=', 'Proslost')->first();
      $old = $event->participantsApplied;

      $this->actingAs($user)
            ->call('GET', "/event/". $event->id ."/signup");
      $event = App\Event::where('name', '=', 'Proslost')->first();
      $this->assertEquals($old, $event->participantsApplied, $message = '', $delta = 0);
    }

    public function textOngoingForSignUp()
    {
      $user = factory(App\User::class, 'reg')->create();
      $event = App\Event::where('name', '=', 'Sadasnjost')->first();
      $old = $event->participantsApplied;

      $this->actingAs($user)
            ->call('GET', "/event/". $event->id ."/signup");
      $event = App\Event::where('name', '=', 'Sadasnjost')->first();
      $this->assertEquals($old, $event->participantsApplied, $message = '', $delta = 0);
    }
}
