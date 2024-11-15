<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::whereBetween('id', [2, 3])->pluck('id')->toArray();
        $occupations = ['Backend Engineer', 'Data Scientist'];
        $genders = ['Male', 'Female'];
        $addresses = ['123 Main St', '456 Baker St'];

        foreach ($userIds as $userId) {
            DB::table('instructors')->insert([
                'user_id'     => $userId,
                'phonenumber' => '+62' . rand(8000000000, 8999999999),
                'occupation'  => $occupations[array_rand($occupations)],
                'gender'      => $genders[array_rand($genders)],
                'address'     => $addresses[array_rand($addresses)],
            ]);
        }

    }
}
