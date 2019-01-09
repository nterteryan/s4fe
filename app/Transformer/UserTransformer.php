<?php

namespace App\Transformer;

use App\Model\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user) : array
    {
        $formattedUser = [
            'id'                    => $user->id,
            'firstName'             => $user->first_name,
            'lastName'              => $user->last_name,
            'middleName'            => $user->middle_name,
            'email'                 => $user->email,
            'phone'                 => $user->phone_number,
            'createdAt'             => (string) $user->created_at,
            'updatedAt'             => (string) $user->updated_at
        ];
        return $formattedUser;
    }
}