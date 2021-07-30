<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\School;
use App\Models\User;

final class ProposalPolicy
{
    public function viewAny(User $user, School $school): bool
    {
        return $user->school()->is($school);
    }

    public function create(User $user, School $school): bool
    {
        return $user->school()->is($school);
    }
}
