<?php

use App\Questionnaire;
use Illuminate\Database\Seeder;

class QuestionnaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 1; $i <= 5; $i++) $data[] = [
        	'title' => $faker->sentence(mt_rand(3, 6)),
            'desc' => $faker->sentence(mt_rand(15, 30)),
        	'user_id' => $i,
        	'created_at' => now(),
        	'updated_at' => now()
        ];
        Questionnaire::insert($data);
    }
}
