<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Role;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => '3104418741',
        'estado' => '1',
        'email_verified_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
    $role = new Role();
    $role->name = 'admin';
    $role->save();
    $factory->roles()->attach($role);
});
