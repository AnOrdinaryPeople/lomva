<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 1
        ]);

        for($i = 0; $i < 8; $i++){
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('12345678'),
                'role' => $i < 4 ? 1 : 0,
                'avatar' => str_replace('public/pic\\', url('/').'/pic/', $faker->image('public/pic', 500, 500, 'people', true, true)),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        User::insert($data);
        User::create([
            'name' => 'Student',
            'email' => 'student@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 0
        ]);
    }
}
