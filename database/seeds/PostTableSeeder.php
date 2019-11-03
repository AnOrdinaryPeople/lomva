<?php

use App\UserPost;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

        for($i = 0; $i < 30; $i++){
        	$type = rand(0, 1);

        	if($type > 0) $user = rand(1, 5);
        	else $user = rand(1, 10);

        	$data[] = [
        		'title' => str_replace('.', '', $faker->sentence(mt_rand(3, 6))),
        		'desc' => $faker->text(255),
        		'type' => $type,
        		'user_id' => $user,
        		'created_at' => now(),
        		'updated_at' => now()
        	];
        }
        UserPost::insert($data);
    }
}
