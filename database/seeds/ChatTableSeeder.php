<?php

use App\Chat;
use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 5; $i++){
            for($j = 0; $j < rand(5, 10); $j++){
                $data[] = [
    	        	'msg' => Faker\Factory::create()->text(100),
    	        	'user_id' => rand(6, 10),
    	        	'chat_with' => $i,
    	        	'created_at' => now(),
    	        	'updated_at' => now()
    	        ];
            }
        }
        for($i = 6; $i <= 10; $i++){
            for($j = 0; $j < rand(5, 10); $j++){
                $data[] = [
                    'msg' => Faker\Factory::create()->text(100),
                    'user_id' => rand(1, 5),
                    'chat_with' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        Chat::insert($data);
    }
}
