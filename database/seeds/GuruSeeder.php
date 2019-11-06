<?php

use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('guru')->insert([
            'name' => ('Jefff',10),
            'email' => ('nameisjeff',10).'@mail.com',
            'kontak' => ('0255458556',20),
            'password'=>('jefff'),
            'ngajar'=>('stigma'),
        ],
        [
        	'name' => ('mayahe',10),
            'email' => ('mayawho',10).'@mail.com',
            'password'=>('mayahi'),
            'kontak' => ('0255458556',20),
            'ngajar'=>('mayahaha'),
        ]
    }
}
