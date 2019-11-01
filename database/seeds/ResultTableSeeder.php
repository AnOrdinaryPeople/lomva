<?php

use App\Result;
use Illuminate\Database\Seeder;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$min = [10, 60, 110, 160];
        $max = [50, 100, 150, 200];

        for($i = 1; $i <= 5; $i++){
        	for($j = 0; $j < 4; $j++){
		        $data[] = [
		        	'quest_id' => $i,
		        	'min_score' => $min[$j],
		        	'max_score' => $max[$j],
		        	'desc' => Faker\Factory::create()->sentence(6, 9),
		        	'created_at' => now(),
		        	'updated_at' => now()
		        ];
        	}
        }
        Result::insert($data);
    }
}
