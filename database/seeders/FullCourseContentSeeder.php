<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonPdf;
use App\Models\LessonVideo;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FullCourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 1; $i <= 2; $i++) {
                $chapter = Chapter::create([
                    'course_id' => $course->id,
                    'title' => "Chapter $i for " . $course->title,
                ]);

                for ($j = 1; $j <= 2; $j++) {
                    $topic = Topic::create([
                        'chapter_id' => $chapter->id,
                        'title' => "Topic $j in " . $chapter->title,
                        'sort_order' => $j,
                        'type' => 'lesson'
                    ]);

                    for ($k = 1; $k <= 2; $k++) {
                        $lessonTypes = ['pdf', 'video'];

                        $lessonType = $lessonTypes[array_rand($lessonTypes)];

                        $lesson = Lesson::create([
                            'topic_id' => $topic->id,
                            'type' => $lessonType,
                        ]);

                        if ($lessonType ===  'video') {
                            LessonVideo::create([
                                'lesson_id' => $lesson->id,
                                'video_url' => 'https://youtu.be/446E-r0rXHI?si=-ZcVd-OKuwi9Rj3f',
                            ]);
                        } elseif ($lessonType === 'pdf') {
                            LessonPdf::create([
                                'lesson_id' => $lesson->id,
                                'pdf_url' => 'https://pdfobject.com/pdf/sample.pdf',
                            ]);
                        }
                    }
                }
            }
        }

        


    }
}
