<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

// use Jenssegers\Mongodb\Eloquent\SoftDeletes as SoftDeletes;

class TitleMongo extends Model
{
    // use SoftDeletes;

	protected $connection = 'mongodb';
	protected $collection = 'titles';

    protected $fillable = [
        'tconst',
        'type_id',
        'primary',
        'original',
        'is_adult',
        'start_year',
        'end_year',
        'runtime_minutes',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function genres()
    {
        return $this->belongsToMany(GenreMongo::class, 'title_genres');
    }

    public function actors()
    {
        return $this->belongsToMany(ActorMongo::class, 'actor_titles');
    }
    
}
