<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\ExerciseBookResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExerciseBooksController extends Controller
{
    public function index()
    {
        $exerciseBooks = auth()->user()->exerciseBooks;
        return ExerciseBookResource::collection($exerciseBooks);
    }
}
