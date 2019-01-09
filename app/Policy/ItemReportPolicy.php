<?php

namespace App\Policy;

use App\Model\User;

/**
 * Class ItemReportPolicy
 * @package App\Policy
 */
class ItemReportPolicy
{
    /**
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isAdmin() && (!$currentUser->tokenCan('basic') || $currentUser->tokenCan('undefined'))) {
            return true;
        }
    }

    /**
     * @param User $requestUser
     * @return bool
     */
    public function store(User $requestUser)
    {
        return $requestUser->hasAbilityToReport();
    }
}