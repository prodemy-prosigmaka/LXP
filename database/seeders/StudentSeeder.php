<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->random(2)->pluck('id');
        $occupations = ['Frontend Engineer', 'Software Engineer'];
        $genders = ['Male', 'Female'];
        $addresses = ['823 Oak St', '754 Pine St'];

        foreach ($userIds as $userId) {
            DB::table('students')->insert([
                'user_id'     => $userId,
                'phonenumber' => '+62' . rand(8000000000, 8999999999),
                'occupation'  => $occupations[array_rand($occupations)],
                'gender'      => $genders[array_rand($genders)],
                'address'     => $addresses[array_rand($addresses)],
            ]);
        }
    }
}
