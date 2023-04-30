<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tconst',
        'type_id',
        'primary',
        'original',
        'is_adult',
        'start_year',
        'end_year',
        'runtime_minutes',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'title_genres');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_titles');
    }

    public function titleRatings()
    {
        return $this->hasOne(TitleRatings::class, 'title_id');
    }
}
