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
        for($i = 0; $i < 15; $i++){
            $id = rand(1, 3);
            switch ($id) {
                case 1:
                    $total = rand(1, 50);
                    break;
                case 2:
                    $total = rand(1, 40);
                    break;
                case 3:
                    $total = rand(25, 50);
                    break;
                
                default:
                    $total = rand(25, 40);
                    break;
            }
            $data[] = [
            	'user_id' => rand(6, 10),
            	'total_score' => $total,
            	'quest_id' => $id,
            	'created_at' => now(),
            	'updated_at' => now()
            ];
        }
        Done::insert($data);
    }
}
