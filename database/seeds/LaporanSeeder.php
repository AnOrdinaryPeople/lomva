<?php

use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('laporan')->insert([
            'nama_laporan' => 1,
            'hasil' =>(''),
            'jawaban' => ('siswa',10),
        ]
    }
}
