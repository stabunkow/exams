<?php

namespace App\Http\Controllers\Api\ExerciseBooks;

use App\Http\Requests\Api\ExerciseBooks\RecordRequest;
use App\Models\ExerciseBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    public function create(ExerciseBook $exerciseBook, RecordRequest $request)
    {
        $this->authorize('update', $exerciseBook);

        $questionsIds = $exerciseBook->questions->pluck('id');
        $wrongQuestionIds = $questionsIds->intersect($request->record)->values()->toArray();

        auth()->user()->wrong_questions()->syncWithoutDetaching($wrongQuestionIds);

        return response()->setStatusCode(201);
    }
}
