<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleUser = Role::where('name', 'user')->first();


        $user = new User();
        $user->name = 'Jhon';
        $user->last_name = 'Doe';
        $user->email = 'doe.example@gmail.com';
        $user->phone = '3133333333';
        $user->password = bcrypt('123456789');
        $user->save();
        $user->roles()->attach($roleAdmin);

        $user = new User();
        $user->name = 'user';
        $user->last_name = 'Cliente';
        $user->email = 'user.example@example.com';
        $user->phone = '3144444444';
        $user->password = bcrypt('789456123');
        $user->save();
        $user->roles()->attach($roleUser);


    }
}
