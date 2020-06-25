<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'client_id' => function(){
        return factory(App\Client::class)->create()->id;
        },
        'transactionDate' => $faker->dateTimeBetween("-2 Month", "now")->format("Y-m-d"),
        'amount' => $faker->randomFloat(2, 1, 100),
    ];
});
