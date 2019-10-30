<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++) $data[] = [
    		'reply' => Faker\Factory::create()->text(255),
    		'post_id' => rand(1, 30),
    		'user_id' => rand(1, 10),
    		'created_at' => now(),
    		'updated_at' => now()
    	];
        Comment::insert($data);
    }
}
