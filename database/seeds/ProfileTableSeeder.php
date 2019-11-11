<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $cls = ['X','XI','XII'];
        $clss = ['RPL','TKJ','OTKP','IPS','IPA','MTK'];

        for($i = 1; $i <= 5; $i++) $data[] = [
        	'phone' => $faker->e164PhoneNumber,
        	'school' => $faker->company,
        	'user_id' => $i,
        	'created_at' => now(),
        	'updated_at' => now()
        ];
        Profile::insert($data);
        for($i = 6; $i <= 10; $i++) $dataa[] = [
        	'phone' => $faker->e164PhoneNumber,
        	'gender' => rand(0, 1),
        	'cls' => $cls[rand(0, 2)].'-'.$clss[rand(0, 5)],
        	'school' => $faker->company,
        	'born' => $faker->date('Y-m-d', '-16 years'),
        	'user_id' => $i,
        	'created_at' => now(),
        	'updated_at' => now()
        ];
        Profile::insert($dataa);
    }
}
