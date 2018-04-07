<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Http\Controllers\Controller;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::query();

        if ($include = request('include')) {
            if (in_array('sections', explode(',', $include))) {
                $subjects = $subjects->with('sections');
            }
        }

        $subjects = $subjects->get();

        return SubjectResource::collection($subjects);
    }
}
