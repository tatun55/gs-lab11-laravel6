<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => "TDさんの近所の住人",
            'email' => "neighborhood@kinjo.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        factory(App\User::class)->create([
            'role' => "admin",
            'name' => "ジーズ山崎",
            'email' => "yamazaki@gs.academy",
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'),
            'remember_token' => Str::random(10),
        ]);
    }
}