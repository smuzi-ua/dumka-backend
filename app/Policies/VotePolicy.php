<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;

final class VotePolicy
{
    public function create(User $user, Proposal $proposal): bool
    {
        return $user->school()->is($proposal->school);
    }
}
