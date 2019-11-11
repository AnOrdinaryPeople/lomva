<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(QuestionnaireTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(ResultTableSeeder::class);
        $this->call(DoneTableSeeder::class);
        $this->call(ChatTableSeeder::class);
        $this->call(pertanyaanSeeder::class);
        $this->call(NewsSeeder::class);
        
    }
}
