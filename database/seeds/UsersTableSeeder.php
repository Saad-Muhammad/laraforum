<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'admin' => 1 ,
            'password' => bcrypt('123456'),
            'email' => 'saad@gmail.com',
            'avatar' => 'uploads/avatars/avatar.png'
        ]);

        App\User::create([
            'name' => 'Editor',
            'password' => bcrypt('123456'),
            'email' => 'editor@gmail.com',
            'avatar' => 'uploads/avatars/avatar.png'
        ]);
    }
}
