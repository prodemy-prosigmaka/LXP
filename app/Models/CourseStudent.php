<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseStudent
 *
 * @property $id
 * @property $student_id
 * @property $course_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Course $course
 * @property Student $student
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CourseStudent extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['student_id', 'course_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id', 'id');
    }
    
}
