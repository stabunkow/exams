<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function questionable()
    {
        return $this->morphTo();
    }

    public function hasBought()
    {
        return \DB::table('user_exercise_book_pivot')
            ->where('exercise_book_id', $this->questionable_id)
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function users_in_wrong()
    {
        return $this->belongsToMany(User::class, 'user_wrong_question_pivot')->withTimestamps();
    }

    public function users_in_favorite()
    {
        return $this->belongsToMany(User::class, 'user_favorite_question_pivot')->withTimestamps();
    }
}
