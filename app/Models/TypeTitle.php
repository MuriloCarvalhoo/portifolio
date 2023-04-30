<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeTitle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function title()
    {
        return $this->hasMany(Title::class);
    }
}
