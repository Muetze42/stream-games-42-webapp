<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
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
     * @param \App\Models\Setting $setting
     *
     * @return bool
     */
    public function view(User $user, Setting $setting): bool
    {
        return $user->getKey() === $setting->user_id;
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
     * @param \App\Models\Setting $setting
     *
     * @return bool
     */
    public function update(User $user, Setting $setting): bool
    {
        return $user->getKey() === $setting->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Setting $setting
     *
     * @return bool
     */
    public function delete(User $user, Setting $setting): bool
    {
        return $user->getKey() === $setting->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Setting $setting
     *
     * @return bool
     */
    public function restore(User $user, Setting $setting): bool
    {
        return $user->getKey() === $setting->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Setting $setting
     *
     * @return bool
     */
    public function forceDelete(User $user, Setting $setting): bool
    {
        return $user->getKey() === $setting->user_id;
    }
}
