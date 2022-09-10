<?php

namespace App\Policies;

use App\Apartment;
use App\Plan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Plan  $plan
     * @return mixed
     */
    public function view(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
                ? Response::allow()
                : Response::deny('You do not own this apartment.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Plan  $plan
     * @return mixed
     */
    public function update(User $user, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Plan  $plan
     * @return mixed
     */
    public function delete(User $user, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Plan  $plan
     * @return mixed
     */
    public function restore(User $user, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Plan  $plan
     * @return mixed
     */
    public function forceDelete(User $user, Plan $plan)
    {
        //
    }
}
