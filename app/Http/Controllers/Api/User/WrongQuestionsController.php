<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WrongQuestionsController extends Controller
{
    public function index()
    {
        $questions = auth()->user()->wrong_questions;
        return QuestionResource::collection($questions);
    }
}
