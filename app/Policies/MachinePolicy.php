<?php

namespace App\Policies;

use App\User;
use App\Machine;
use Illuminate\Auth\Access\HandlesAuthorization;

class MachinePolicy
{
    use HandlesAuthorization;

    public function create(User $user, Machine $machine)
    {
        return $user->id === $machine->created_by;
    }

    public function owner(User $user, Machine $machine)
    {
        return $user->id === $machine->created_by;
    }
}
