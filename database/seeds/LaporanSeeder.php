<?php

use Illuminate\Database\Seeder;
use App\Result;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       [
            'nama_laporan' => 1,
            'hasil' =>(''),
            'jawaban' => ('siswa',10),
        ];
        Result::insert($data);
    }
}
