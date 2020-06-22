<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Client::class, function (Faker $faker) {
    $avatar = UploadedFile::fake()->image('logo.jpg', 100, 100)->size(100);
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'avatar' => $avatar,
        'email' => $faker->unique()->safeEmail
    ];
});
