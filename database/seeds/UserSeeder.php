<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Garion', 'email' => 'garion@silverstripe.com', 'password' => bcrypt('test')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Make Garion a god because he is one
        User::find(1)->roles()->attach(1);
    }
}
