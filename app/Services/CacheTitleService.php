<?php

namespace App\Services;

use App\Models\Title;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;

class CacheTitleService
{
    public static function get_title($request) {
        $key = null;
        $key = $request->page ? $key . 'titles-page-' . $request->page : $key . 'titles-page-' . 1;
        $key = $request->tconst ? $key . 'tconst-' . $request->tconst : $key;
        $key = $request->primary ? $key . 'primary-' . $request->primary : $key;
        $key = $request->original ? $key . 'original-' . $request->original : $key;
        $key = $request->start_year ? $key . 'start_year-' . $request->start_year : $key;
        $key = $request->end_year ? $key . 'end_year-' . $request->end_year : $key;
        $key = $request->runtime_minutes ? $key . 'runtime_minutes-' . $request->runtime_minutes : $key;
        $key = $request->type_id ? $key . 'type_id-' . $request->type_id : $key;
        $key = $request->isAdult ? $key . 'isAdult-' . $request->isAdult : $key;
        $key = $request->genre ? $key . 'genre-' . $request->genre : $key;

        $title = Cache::rememberForever( $key, function () use ($request) {
                return Title::select('id', 'tconst', 'type_id', 'primary', 'original', 'is_adult', 'start_year', 'end_year', 'runtime_minutes')
                ->with('genres:id,name')
                ->when($request->tconst, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('tconst', 'like', '%'. $request->tconst . '%');
                    });
                })            
                ->when($request->primary, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('primary', 'like', '%'. $request->primary . '%');
                    });
                })
                ->when($request->original, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('original', 'like', '%'. $request->original . '%');
                    });
                })
                ->when($request->start_year, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('start_year', 'like', '%'. $request->start_year . '%');
                    });
                })
                ->when($request->end_year, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('end_year', 'like', '%'. $request->end_year . '%');
                    });
                })
                ->when($request->runtime_minutes, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('runtime_minutes', 'like', '%'. $request->runtime_minutes . '%');
                    });
                })            
                ->when($request->type_id, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('type_id', $request->type_id);
                    });
                })
                ->when($request->isAdult, function ($query) use ($request) {
                    $query->where(function($query) use ($request) {
                        $query->where('is_adult', $request->isAdult);
                    });
                })
                ->when($request->genre, function ($query) use ($request) {
                    $query->whereHas('genres', function ($query) use ($request) {
                        $query->where('genre_id', $request->genre);
                    });
                })    
                ->orderBy('id', 'desc')
                ->paginate(30);
            }
        );
        return $title;
    }

}
