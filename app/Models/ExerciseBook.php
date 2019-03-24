<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseBook extends Model
{
    public function questions()
    {
        return $this->morphMany('App\Models\Question', 'questionable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_exercise_book_pivot')->withTimestamps();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function hasBought()
    {
        return \DB::table('user_exercise_book_pivot')
            ->where('exercise_book_id', $this->id)
            ->where('user_id', auth()->id())
            ->exists();
    }
}
