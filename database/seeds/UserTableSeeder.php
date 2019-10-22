<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[
        		'email' => 'admin@mail.com',
        		'password' => Hash::make('12345678'),
        		'role' => 1
        	],[
        		'email' => 'user@mail.com',
        		'password' => Hash::make('12345678')
        	]
        ]);
    }
}
