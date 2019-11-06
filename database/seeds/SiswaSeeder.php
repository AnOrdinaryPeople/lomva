<?php

use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('siswa')->insert([
            'name' => ('adiputra',10),
            'email' => ('adiputra',10).'@mail.com',
            'kelas' => ('XII-RPL',10),
            'password'=>('anugrah'),
            'kontak' => ('089665203123',20),
            'tgl_lahir'=>('2001-06-21'),
            'asal_sekolah'=>('Mts Persis Tarogong',10),
            'asal_daerah'=>('Kosambi',10),
        ],
        [
        	'name' => ('azrael',10),
            'email' => ('azreal',10).'@mail.com',
            'kelas' => ('XI-RPL',10),
            'password'=>('thyhead'),
            'kontak' => ('089665245521',20),
            'tgl_lahir'=>('2001-06-21'),
            'asal_sekolah'=>('Baknus',10),
            'asal_daerah'=>('Bambang',10),
        ]
    }
}
