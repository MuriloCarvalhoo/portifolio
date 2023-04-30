<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'title_id',
    ];
}
