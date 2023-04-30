<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleGenre extends Model
{
    use HasFactory;

    protected $table = 'title_genres';

    protected $fillable = [
        'title_id',
        'genre_id',
    ];
}
