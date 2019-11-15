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
        Answer::insert([
            // kuesioner 1
            [                           // soal 1
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 2
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 3
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 4
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 5
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 6
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [                           // soal 7
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 8
                'answer' => 'Tidak Pernah',
                'score' => 5,
                'q_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Jarang',
                'score' => 4,
                'q_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang-Kadang',
                'score' => 3,
                'q_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sangat Sering',
                'score' => 1,
                'q_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // kuesioner 2
            [                           // soal 1
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 2
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 3
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 4
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 5
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 6
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 14,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 14,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 14,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 14,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 7
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 8
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 9
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 10
                'answer' => 'Tidak pernah',
                'score' => 4,
                'q_id' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Kadang kadang',
                'score' => 3,
                'q_id' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Sering',
                'score' => 2,
                'q_id' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Selalu',
                'score' => 1,
                'q_id' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // kuesioner 3
            [                           // soal 1
                'answer' => 'Ya',
                'score' => 5,
                'q_id' => 19,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Tidak',
                'score' => 10,
                'q_id' => 19,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 2
                'answer' => 'Ya',
                'score' => 5,
                'q_id' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Tidak',
                'score' => 10,
                'q_id' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 3
                'answer' => 'Ya',
                'score' => 5,
                'q_id' => 21,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Tidak',
                'score' => 10,
                'q_id' => 21,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 4
                'answer' => 'Ya',
                'score' => 5,
                'q_id' => 22,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Tidak',
                'score' => 10,
                'q_id' => 22,
                'created_at' => now(),
                'updated_at' => now()
            ],[                           // soal 5
                'answer' => 'Ya',
                'score' => 5,
                'q_id' => 23,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'answer' => 'Tidak',
                'score' => 10,
                'q_id' => 23,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
