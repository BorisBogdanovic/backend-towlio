<?php

namespace App\Observers;
use App\Helpers\PhoneHelper;
use App\Models\User;

class UserObserver
{
     public function creating(User $user): void
    {
        $user->phone = PhoneHelper::formatPhone($user->phone);
    }

    public function updating(User $user): void
    {
        $user->phone = PhoneHelper::formatPhone($user->phone);
    }
}
