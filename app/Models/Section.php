<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function exercise_books()
    {
        return $this->hasMany(ExerciseBook::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
