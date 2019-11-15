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
        Questionnaire::insert([
            [
                'title' => 'Mengetes diri sendiri',
                'desc' => 'aaaaaaaa',
                'category' => 4,
                'user_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'title' => 'Kesehatan Mental',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category' => 4,
                'user_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'title' => 'Personality Test',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category' => 4,
                'user_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
