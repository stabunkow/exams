<?php

namespace App\Http\Controllers\Api\ExerciseBooks\Questions;

use App\Http\Resources\QuestionResource;
use App\Models\ExerciseBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function index(ExerciseBook $exerciseBook)
    {
        $this->authorize('update', $exerciseBook);
        $questions = $exerciseBook->questions;

        return QuestionResource::collection($questions);
    }
}
