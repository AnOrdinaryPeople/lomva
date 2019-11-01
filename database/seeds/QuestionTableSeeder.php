<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 5; $i++){
        	for($j = 1; $j <= 5; $j++){
        		$data[] = [
	        		'number' => $j,
	        		'question' => Faker\Factory::create()->sentence(mt_rand(3, 6)),
	        		'quest_id' => $i,
	        		'created_at' => now(),
	        		'updated_at' => now()
	        	];
        	}
        }
        Question::insert($data);
    }
}
