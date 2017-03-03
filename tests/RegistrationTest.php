<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function testRequiredFields()
    {
        $this->visit('/register')
            ->type('Taylor', 'username')
            ->type('taylor@test.com', 'email')
            ->type('testpassword', 'password')
            ->type('testpassword', 'password_confirmation')
            ->press('register')
            ->seePageIs('/');

        $this->seeInDatabase('users', ['username' => 'Taylor']);
    }

    public function testEmailCorrectFormatRequired()
    {
        $this->visit('/register')
            ->type('Taylor', 'username')
            ->type('taylor', 'email')
            ->type('testpassword', 'password')
            ->type('testpassword', 'password_confirmation')
            ->press('register')
            ->seePageIs('/register');

        $this->visit('/register')
            ->type('Taylor', 'username')
            ->type('taylor@test', 'email')
            ->type('testpassword', 'password')
            ->type('testpassword', 'password_confirmation')
            ->press('register')
            ->seePageIs('/register');

        $this->visit('/register')
            ->type('Taylor', 'username')
            ->type('taylor@test.com', 'email')
            ->type('testpassword', 'password')
            ->type('testpassword', 'password_confirmation')
            ->press('register')
            ->seePageIs('/');

        $this->seeInDatabase('users', ['username' => 'Taylor']);
    }

}
