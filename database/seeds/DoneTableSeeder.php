<?php

use App\Done;
use Illuminate\Database\Seeder;

class DoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 15; $i++) $data[] = [
        	'user_id' => rand(6, 10),
        	'total_score' => rand(10, 200),
        	'quest_id' => rand(1, 5),
        	'created_at' => now(),
        	'updated_at' => now()
        ];
        Done::insert($data);
    }
}
