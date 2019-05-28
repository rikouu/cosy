<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends Policy
{
    /**
     * Determine if the given user can view the user.
     *
     * @param User $user
     * @param User $userModal
     *
     * @return bool
     */
    public function view(User $user, User $userModal)
    {
        return false;
    }

    /**
     * Determine if the given user can create a user.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param User $user
     * @param User $userModol
     *
     * @return bool
     */
    public function update(User $user, User $userModol)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param User $user
     * @param User $userModol
     *
     * @return bool
     */
    public function destroy(User $user, User $userModol)
    {
        return false;
    }

}
