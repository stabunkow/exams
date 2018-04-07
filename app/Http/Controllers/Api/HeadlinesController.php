<?php

namespace App\Http\Controllers\Api;

use App\Models\Headline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HeadlinesController extends Controller
{
    public function index()
    {
        $headlines = Headline::whereIsEnabled(1)
            ->select(['id', 'title', 'image', 'published_at'])
            ->where('published_at', '<', now())
            ->get();

        return response()->json($headlines);
    }
}
