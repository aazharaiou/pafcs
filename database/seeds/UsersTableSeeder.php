<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Azhar ul Islam',
            'email' => 'azhar@azhar.com',
            'password' => Hash::make('demo'),
        ]);
    }
}
