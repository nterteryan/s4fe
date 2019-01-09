<?php

namespace App\Policy;

use App\Model\Item;
use App\Model\User;

/**
 * Class ItemPolicy
 * @package App\Policy
 */
class ItemPolicy
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
     * @param User $currentUser
     * @param Item $item
     * @return bool
     */
    public function update(User $currentUser, Item $item): bool
    {
        return $this->isItemOwner($currentUser, $item);
    }

    /**
     * @param User $currentUser
     * @param Item $item
     * @return bool
     */
    public function destroy(User $currentUser, Item $item): bool
    {
        return $this->isItemOwner($currentUser, $item);
    }

    /**
     * @param User $currentUser
     * @param Item $item
     * @return bool
     */
    private function isItemOwner(User $currentUser, Item $item): bool
    {
        return $currentUser->id === $item->user_id;
    }
}