<?php

namespace App\Policies;

use App\Models\ExerciseBook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExerciseBookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, ExerciseBook $exerciseBook)
    {
        return $exerciseBook->hasBought();
    }
}
