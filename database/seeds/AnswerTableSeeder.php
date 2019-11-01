<?php

use App\Answer;
use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $score = [0, 10, 20, 30, 40];
        
        for($i = 1; $i <= 25; $i++){
        	for($j = 1; $j <= 4; $j++){
        		$data[] = [
        			'answer' => Faker\Factory::create()->sentence(rand(3, 6)),
        			'q_id' => $i,
                    'score' => $score[$j],
        			'created_at' => now(),
        			'updated_at' => now()
        		];
        	}
        }
        Answer::insert($data);
    }
}
