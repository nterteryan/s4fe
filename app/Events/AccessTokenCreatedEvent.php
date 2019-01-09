<?php

namespace App\Events;

use App\Model\User;

/**
 * Class AccessTokenCreatedEvent
 * @package App\Events
 */
class AccessTokenCreatedEvent
{
    /**
     * @var User
     */
    protected $user;

    /**
     * AccessTokenCreatedEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}