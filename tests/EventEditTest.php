<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventEditTest extends TestCase
{
    use DatabaseTransactions;

    public function testEditEvent()
    {
        $user = App\User::where([ 'username' => 'Bajic' ])->first();
        $event_id = App\Event::where([ 'name' => 'Ciscenje Tasa' ])->first()->id;

        $this->actingAs($user)
            ->visit("/event/$event_id/edit")
            ->type('Ciscenje parka', 'title')
            ->type('park', 'location')
            ->press('edit')
            ->seePageIs("/event/$event_id/edit");

        $this->seeInDatabase('events',
        ['id' => $event_id, 'name' => 'Ciscenje parka', 'location' => 'park' ]);
    }

    public function testWrongInput()
    {
      $user = App\User::where([ 'username' => 'Bajic' ])->first();
      $event = App\Event::where([ 'name' => 'Ciscenje Tasa' ])->first();

      $this->actingAs($user)
          ->visit("/event/$event->id/edit")
          ->type(':D', 'participantsNeeded')
          ->press('edit')
          ->seePageIs("/event/$event->id/edit");

      $this->seeInDatabase('events', ['id' => $event->id, 'participantsNeeded' => $event->participantsNeeded ]);
    }

}
