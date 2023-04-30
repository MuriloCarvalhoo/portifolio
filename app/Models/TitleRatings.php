<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TitleRatings extends Model
{
    use SoftDeletes;

    protected $table = 'title_ratings';

    protected $fillable = [
        'title_id',
        'tconst',
        'average_rating',
        'num_votes',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
