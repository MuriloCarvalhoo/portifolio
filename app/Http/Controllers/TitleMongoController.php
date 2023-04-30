<?php

namespace App\Http\Controllers;

use App\Models\Mongo\TitleMongo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TitleMongoController extends Controller
{
    public function index()
    {
        return Inertia::render('Title/IndexMongo');
    }

    public function get(Request $request)
    {
        $limit = 30;
        $projections = ['id', 'tconst', 'type_id', 'primary', 'original', 'is_adult', 'start_year', 'end_year', 'runtime_minutes'];

        $records = TitleMongo::with('genres')
        ->paginate($limit, $projections);


        return response()->json($records);
    }
}
