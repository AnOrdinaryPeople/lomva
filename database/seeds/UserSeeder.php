<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data[]=[
            'name' => ('adiputra',10),
            'email' => ('schoolid',10).'@mail.com',
            'password' => bcrypt('12345'),
            'status' => ('siswa',10),
        ],
        [
        	'name'=>('jeff',10),
        	'email'=>('jeffid',10).'@mail.com',
        	'password'=> bcrypt('12345'),
        	'status'=> ('guru',10),
        ],
        [
        	'name'=>('admin',10),
        	'email'=>('administrator',10).'@mail.com',
        	'password'=>bcrypt('admin'),
        	'status'=>('admin',10),
        ],
        [
        	'name'=>('ray',10),
        	'email'=>('rayan',10).'@mail.com',
        	'password'=>bcrypt('12345'),
        	'status'=>('kepala sekolah'),
        ];
    User::insert($data);
    }
}