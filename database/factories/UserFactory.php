<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(U\User::class, function (Faker $faker) {

    return [
        'name' => 'Anderson Rodriguez',
        'username' => 'andiirc',
        'email' => 'andiirc@gmail.com',
        'password' => 'confidencial',
        'city' => 'Bogota',
        'admin' => true,
        'hobby' => [ "video juegos", "Tocar Guitarra" ],
        'remember_token' => str_random(10),
        'api_token'=> str_random(60)
    ];

});
