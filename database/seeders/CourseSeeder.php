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

        $images = [
            'https://images.unsplash.com/photo-1499673610122-01c7122c5dcb?q=80&w=1927&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1485988412941-77a35537dae4?q=80&w=1796&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ];

        foreach ($titles as $index => $title) {
            DB::table('courses')->insert([
                'instructor_id' => $instructorIds[array_rand($instructorIds)],
                'title'         => $title,
                'caption'       => $captions[$index],
                'description'   => $descriptions[$index],
                'image'         => $images[$index]
            ]);
        }
    }
}
