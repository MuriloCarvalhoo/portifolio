<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class ActorMongo extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'actors';

    protected $fillable = [
        'nconst',
        'name',
        'birth_year',
        'death_year',
        'primary_profession',
        'known_for_titles',
    ];
}
