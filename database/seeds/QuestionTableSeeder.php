<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::insert([
            // kuesioner 1
            [
                'number' => 1,
                'question' => 'Seberapa sering masalah yang sedang terjadi mengganggu aktivitas sehari-hari',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 2,
                'question' => 'Seberapa sering kamu menceritakan masalahmu kepada orang lain? Misal kepada teman atau keluarga',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 3,
                'question' => 'Seberapa sering kamu kehilangan kontrol diri, misalnya marah, menangis atau bertndak agresif?',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 4,
                'question' => 'Seberapa sering kamu sulit mengungkapkan masalahmu pada orang lain? Misal kepada teman atau keluarga',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 5,
                'question' => 'Seberapa sering kamu merasa tidak percaya diri dalam menghadapi masalah yang sedang terjadi?',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 6,
                'question' => 'Seberapa sering kamu menghindari orang-orang disekitar karena masalah yang sedang terjadi',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 7,
                'question' => 'Seberapa sering kamu menyendiri karena masalah yang sedang terjadi',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 8,
                'question' => 'Seberapa sering kamu merasa orang-orang disekitar tidak peduli kepadamu',
                'quest_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // kuesioner 2
            [
                'number' => 1,
                'question' => 'Merasa tidak yakin atas kemampuan saya',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 2,
                'question' => 'Masalah kecil dengan mudah dapat mengecewakan',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 3,
                'question' => 'Khawatir tentang masa depan saya',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 4,
                'question' => 'Kurang mampu mengambil keputusan',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 5,
                'question' => 'Mengalami suasana hati yang berubah-ubah',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 6,
                'question' => 'Menderita karena merasa tidak aman',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 7,
                'question' => 'Orang lain harus menolong saya membuat keputusan',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 8,
                'question' => 'Bahkan ketika di dalam kelompok saya merasa tidak aman',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 9,
                'question' => 'Merasa kehilangan pengharapan atas diri',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 10,
                'question' => 'Tidak dapat membuat keputusan bahkan ketika saya ingin melakukan sesuatu yang khusus',
                'quest_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // kuesioner 3
            [
                'number' => 1,
                'question' => 'Ada kalanya anda merasa ingin berkelahi dengan seseorang',
                'quest_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 2,
                'question' => 'Dalam menghadapi suatu hal, Anda lebih gugup dibandingkan orang lain',
                'quest_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 3,
                'question' => 'Kadang-kadang Anda menghalangi orang yang mencoba berbuat sesuatu, bukan karena besar keculnya persoalan, akan tetapi karena suatu prinsip',
                'quest_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 4,
                'question' => 'Kadang-kadang bila malu dan tersinggung, Anda mandi keringat dan hal ini sangat mengganggu Anda',
                'quest_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'number' => 5,
                'question' => 'Anda tidak mempersalahkan orang yang akan mengambil keuntungan dari seseorang yang lengah',
                'quest_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
