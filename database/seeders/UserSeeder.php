<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Default user
         */
        User::create([
            'name' => 'Dummy PSM',
            'email' => 'dummy@prosigmaka.com',
            'password' => Hash::make('dummypsm'),
        ]);

        /**
         * Generate 5 random user
         */
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}