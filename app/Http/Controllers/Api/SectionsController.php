<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Section::all();

        return SectionResource::collection($sections);
    }
}
