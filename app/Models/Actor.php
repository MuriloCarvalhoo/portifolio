<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nconst',
        'name',
        'birth_year',
        'death_year',
        'primary_profession',
        'known_for_titles',
    ];

    public function professions()
    {
        return $this->belongsToMany(Profession::class, 'actor_professions');
    }

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'actor_titles');
    }
}
