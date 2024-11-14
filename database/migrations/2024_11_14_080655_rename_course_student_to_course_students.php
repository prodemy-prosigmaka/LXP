<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCourseStudentToCourseStudents extends Migration
{
    public function up()
    {
        Schema::rename('course_student', 'course_students');
    }

    public function down()
    {
        Schema::rename('course_student', 'course_students');
    }
}
