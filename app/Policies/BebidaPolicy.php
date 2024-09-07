<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Bebida;
use App\Models\User;

class BebidaPolicy
{
  
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bebida $bebida): Response
    {
        return $user->id === $bebida->user_id ? Response::allow()
        : Response::deny('No eres el dueño de la bebida.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bebida $bebida): Response
    {
        return $user->id === $bebida->user_id? Response::allow()
        : Response::deny('No eres el dueño de la bebida.');
    }
}
