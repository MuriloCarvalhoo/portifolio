<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class TitleGenreMongo extends Model
{
    protected $table = 'title_genres';

    protected $fillable = [
        'title_id',
        'genre_id',
    ];
}
