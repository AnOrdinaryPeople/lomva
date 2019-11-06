<?php

use Illuminate\Database\Seeder;

class pertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('pertanyaan')->insert([
            'id_siswa' => '',
            'pertanyaan' => ('Seberapa sering masalah yang sedang terjadi mengganggu aktivitas sehari-hari? '),
            'jawaban' => ('sangat sering',50),
        ],
        [
        	  'id_siswa' => '',
            'pertanyaan' => ('Seberapa sering kamu menceritakan masalahmu kepada orang lain? Misal kepada teman atau keluarga '),
            'jawaban' => ('sangat sering',50),
        ],
        [
        	'id_siswa' => '',
        	'pertanyaan' => ('Seberapa sering kamu kehilangan kontrol diri, misalnya marah, menangis atau bertindak agresif ?'),
        	'jawaban' => ('Sangat Sering',50),
        ],
        [
        	'id_siswa' => '',
        	'pertanyaan'=>('Seberapa sering kamu sulit mengungkapkan masalahmu pada orang lain? Misal kepada teman atau keluarga'),
        	'jawaban' => ('Sangat Sering',50),
        ],
        [
        	'id_siswa' =>'',
        	'pertanyaan'=>('Seberapa sering kamu merasa tidak percaya diri dalam menghadapi masalah yang sedang terjadi?'),
        	'jawaban'=>('Sangat Sering',50),
        ],
        [
        	'id_siswa'=>'',
        	'pertanyaan'=>('Seberapa sering kamu menghindari orang-orang disekitar karena masalah yang sedang terjadi?'),
        	'jawaban'=>('Sangat Sering',50),
        ],
        [
        	'id_siswa'=>'',
        	'pertanyaan'=>('Seberapa sering kamu menyendiri karena masalah yang terjadi?'),
        	'jawaban'=>('Sangat Sering',50),
        ],
        [
        	'id_siswa'=>'',
        	'pertanyaan'=>('Seberapa sering kamu merasa orang-orang disekitar tidak peduli kepadamu?'),
        	'jawaban'=>('SANGAT SERING',50),
        ]
    }
}
