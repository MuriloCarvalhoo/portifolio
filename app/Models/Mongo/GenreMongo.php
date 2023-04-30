<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class GenreMongo extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'genres';

    protected $fillable = [
        'name',
    ];
}
