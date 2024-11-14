<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 *
 * @property $id
 * @property $instructor_id
 * @property $title
 * @property $caption
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Instructor $instructor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Course extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['instructor_id', 'title', 'caption', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor()
    {
        return $this->belongsTo(\App\Models\Instructor::class, 'instructor_id', 'id');
    }
    
}
