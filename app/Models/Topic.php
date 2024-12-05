<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 *
 * @property $id
 * @property $chapter_id
 * @property $title
 * @property $sort_order
 * @property $type
 * @property $created_at
 * @property $updated_at
 *
 * @property Chapter $chapter
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Topic extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['chapter_id', 'title', 'sort_order', 'type'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo(\App\Models\Chapter::class, 'chapter_id', 'id');
    }

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'topic_id');
    }

    public function practice()
    {
        return $this->hasOne(Practice::class, 'topic_id');
    }
}
