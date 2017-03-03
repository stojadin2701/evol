<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        //'id' => $faker->numberBetween($min = 1000, $max = 9000),
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'username' => $faker->firstName($gender = null),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'city' => $faker->city,
        'bio' => $faker->text($maxNbChars = 100),
    ];
});

$factory->defineAs(App\User::class, 'reg', function ($faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['privilege' => 0]);
});

$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['privilege' => 1]);
});

$factory->defineAs(App\User::class, 'mod', function ($faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['privilege' => 2]);
});

$factory->define(App\Event::class, function(Faker\Generator $faker) {
    return [
      //'id' => $faker->numberBetween($min = 1000, $max = 9000),
      'name' => $faker->text($maxNbChars = 20),
      'location' => $faker->address,
      'summary' => $faker->text($maxNbChars = 30),
      'description' => $faker->text($maxNbChars = 300),
      'participantsNeeded' => $faker->numberBetween($min = 5, $max = 50),
      'participantsApplied' => $faker->numberBetween($min = 0, $max = 0),
      'status' => 'CRE',
  ];
});

$factory->defineAs(App\Event::class, 'past', function ($faker) use ($factory) {
    $event = $factory->raw(App\Event::class);
    $from = $faker->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = 'Europe/Belgrade');
    $to = $faker->dateTimeBetween($startDate = '-4 days', $endDate = 'now', $timezone = 'Europe/Belgrade');

    return array_merge($event, ['dateTimeFrom' => DateTime(''), 'dateTimeTo' => $to]);
});

$factory->defineAs(App\Event::class, 'current', function ($faker) use ($factory) {
    $event = $factory->raw(App\Event::class);
    $from = $faker->dateTimeBetween($startDate = '-3 hours', $endDate = 'now', $timezone = 'Europe/Belgrade');
    $to = $faker->dateTimeBetween($startDate = 'now', $endDate = '+3 hours', $timezone = 'Europe/Belgrade');

    return array_merge($event, ['dateTimeFrom' => $from, 'dateTimeTo' => $to]);
});

$factory->defineAs(App\Event::class, 'future', function ($faker) use ($factory) {
    $event = $factory->raw(App\Event::class);
    //$from = '2016-06-20 10:00:00';
    //$to = '2016-06-20 13:00:00';
    $from = $faker->dateTimeThisYear('+1 month');
    $to = strtotime('+1 Week', $from->getTimestamp());

    return array_merge($event, ['dateTimeFrom' => $from, 'dateTimeTo' => $to]);
});

$factory->define(App\Feedback::class, function(Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween($min = 1000, $max = 9000),
        'content' => $faker->text($maxNbChars = 50),
        'user_id' => 1,
        'category_id' => 1
    ];
});