<?php

namespace App\Http\Controllers\Api\Questions;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function star(Question $question)
    {
        $this->authorize('update', $question);

        auth()->user()->favorite_questions()->syncWithoutDetaching($question->id);
        return response()->setStatusCode(200);
    }

    public function unstar(Question $question)
    {
        $this->authorize('update', $question);

        auth()->user()->favorite_questions()->detach($question->id);
        return response()->setStatusCode(200);
    }

    public function correct(Question $question)
    {
        $this->authorize('update', $question);

        auth()->user()->wrong_questions()->detach($question->id);
        return response()->setStatusCode(200);
    }
}
