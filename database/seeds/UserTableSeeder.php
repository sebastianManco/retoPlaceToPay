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
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();


        $user = new User();
        $user->name = 'Sebastián';
        $user->last_name = 'Manco Valencia';
        $user->email = 'sebastian.manco1997@gmail.com';
        $user->phone = '3104418741';
        $user->password = bcrypt('123456789');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'isabel';
        $user->last_name = 'palacio bran';
        $user->email = 'admin@example.com';
        $user->phone = '3146656083';
        $user->password = bcrypt('789456123');
        $user->save();
        $user->roles()->attach($role_user);


    }
}
