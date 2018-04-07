<?php

namespace App\Http\Controllers\Api\ExerciseBooks;

use App\Http\Resources\ExerciseBookResource;
use App\Models\ExerciseBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExerciseBooksController extends Controller
{
    public function index()
    {
        $exerciseBooks = ExerciseBook::query();

        if ($sectionId = request('section_id')) {
            $exerciseBooks = $exerciseBooks->whereSectionId($sectionId);
        }

        $exerciseBooks = $exerciseBooks->orderByDesc('updated_at')
            ->with('section')
            ->paginate(10);

        return ExerciseBookResource::collection($exerciseBooks);
    }

    public function show(ExerciseBook $exerciseBook)
    {
        $exerciseBook = $exerciseBook->load(['section', 'questions']);
        return new ExerciseBookResource($exerciseBook);
    }
}
