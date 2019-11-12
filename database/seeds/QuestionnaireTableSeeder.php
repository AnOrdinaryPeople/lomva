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
        $data[] = [
            'title'=>'Mengetes Diri Sendiri',
            'desc'=>'Test Untuk Mengetahui Diri Sendiri',
            'user_id'=>$i,
            'created_at'=>now(),
            'updated_at'=>now()
        ],
        [
        	'title' => 'Mengetes Tingkat Kesehatan Mental',
            'desc' => 'Test Untuk Mengukur Kesehatan Mental.',
        	'user_id' => $i,
        	'created_at' => now(),
        	'updated_at' => now()
        ],
        [
            'title'=>'Cek Tingkat Depresi Kamu Lewat Test Ini',
            'desc'=> 'Tes Psikologi untuk Melihat Sebesar apa Depresi Diri Anda.',
            'user_id'=>$i,
            'created_at'=>now(),
            'updated_at'=>now()
        ],
        [
            'title'=>'Mengukur Tingkat Stress',
            'desc'=>'Test Untuk Mengukur Tingkat Stress Yang Dimiliki.',
            'user_id'=>$i,
            'created_at'=>now(),
            'updated_at'=>now()
        ];
        Questionnaire::insert($data);
    }
}
