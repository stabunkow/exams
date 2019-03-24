<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function exercise_books()
    {
        return $this->belongsToMany(ExerciseBook::class, 'user_exercise_book_pivot')->withTimestamps();
    }

    public function wrong_questions()
    {
        return $this->belongsToMany(Question::class, 'user_wrong_question_pivot')->withTimestamps();
    }

    public function favorite_questions()
    {
        return $this->belongsToMany(Question::class, 'user_favorite_question_pivot')->withTimestamps();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
