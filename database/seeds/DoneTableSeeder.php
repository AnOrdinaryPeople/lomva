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
        for($i = 1; $i <= 5; $i++) $data[] = [
        	'user_id' => $i + 5,
        	'total_score' => rand(10, 200),
        	'quest_id' => $i,
        	'created_at' => now(),
        	'updated_at' => now()
        ];
        Done::insert($data);
    }
}
