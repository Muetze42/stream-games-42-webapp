<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
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
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
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
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->getKey() === $model->getKey();
    }
}