<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructorIds = Instructor::pluck('id')->toArray();

        $titles = [
            'Machine Learning with Python',
            'Build Backend with Go',
        ];

        $captions = [
            'An introduction to machine learning concepts.',
            'Deep dive into backend development with Go.',
        ];

        $descriptions = [
            'Learn machine learning algorithms, model evaluation, and hands-on projects in Python.',
            'An advanced course on backend development covering from the basics of Go syntax to advanced concepts in concurrent programming and web development.',
        ];

        foreach ($titles as $index => $title) {
            DB::table('courses')->insert([
                'instructor_id' => $instructorIds[array_rand($instructorIds)],
                'title'         => $title,
                'caption'       => $captions[$index],
                'description'   => $descriptions[$index]
            ]);
        }
    }
}
