<?php

namespace App\Policies;

use App\Models\Contragent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContragentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Contragent $contragent): bool
    {
        return $user->id === $contragent->user_id;
    }
}
