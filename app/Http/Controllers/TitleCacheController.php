<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CacheTitleService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class TitleCacheController extends Controller
{
    public function index()
    {
        return Inertia::render('Title/IndexCacheRedis');
    }

    public function get(Request $request)
    {
        $titles = CacheTitleService::get_title($request);

        return response()->json($titles);
        
    }
}
