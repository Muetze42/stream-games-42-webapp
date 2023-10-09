<?php

namespace App\Policies;

use App\Models\Score;
use App\Models\User;

class ScorePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Score $score
     *
     * @return bool
     */
    public function view(User $user, Score $score): bool
    {
        return $user->getKey() === $score->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

   /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Score $score
     *
     * @return bool
     */
    public function update(User $user, Score $score): bool
    {
        return $user->getKey() === $score->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Score $score
     *
     * @return bool
     */
    public function delete(User $user, Score $score): bool
    {
        return $user->getKey() === $score->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Score $score
     *
     * @return bool
     */
    public function restore(User $user, Score $score): bool
    {
        return $user->getKey() === $score->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Score $score
     *
     * @return bool
     */
    public function forceDelete(User $user, Score $score): bool
    {
        return $user->getKey() === $score->user_id;
    }
}
