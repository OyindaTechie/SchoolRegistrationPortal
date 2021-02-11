<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Teacher;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        //

        'firstName' => $faker->name,
        'lastName' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456') // password
        
    ];
});
