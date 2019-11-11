<?php

use Illuminate\Database\Seeder;
use App\Answer;

class JawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[]=[
            'id_pertanyaan' => '1',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [
            'id_pertanyaan' => '1',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [
        	'id_pertanyaan' => '1',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [
        	'id_pertanyaan' => '1',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [
        	'id_pertanyaan' => '1',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [
        	'id_pertanyaan' => '2',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [
        	'id_pertanyaan' => '2',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '2',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '2',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '2',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '3',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '3',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '3',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '3',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '3',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '4',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [

        	'id_pertanyaan' => '4',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [

        	'id_pertanyaan' => '4',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '4',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '4',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '5',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '5',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '5',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '5',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '5',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '6',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '6',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '6',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '6',
            'jawaban' => ('Jarang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '6',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '7',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '7',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '7',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '7',
            'jawaban' => ('jarang',50),
            'hasil' => (''),
        ],
        [

        	 'id_pertanyaan' => '7',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '8',
            'jawaban' => ('Sangat Sering',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '8',
            'jawaban' => ('Sering',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '8',
            'jawaban' => ('Kadang-Kadang',50),
            'hasil' => (''), 
        ],
        [
        	 'id_pertanyaan' => '8',
            'jawaban' => ('Jarang ',50),
            'hasil' => (''),
        ],
        [
        	 'id_pertanyaan' => '8',
            'jawaban' => ('Jarang Sekali',50),
            'hasil' => (''),
        ];
        Jawaban::insert($data);
    }
}
