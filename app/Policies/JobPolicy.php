<?php

namespace App\Policies;

use App\Models\Newjob;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, string $role_): bool
    {
        //
            // dd(Auth::user()->role);
            return Auth::user()->role === $role_;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Newjob $newjob): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->role === 'Employer';

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Newjob $newjob): bool
    {
        //
        return $user->user_id == $newjob->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Newjob $newjob): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Newjob $newjob): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Newjob $newjob): bool
    {
        //
    }
}
