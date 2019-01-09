<?php

namespace App\Transformer\User;

use App\Model\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserMeTransformer
 * @package App\Transformer\User
 */
class UserMeTransformer extends TransformerAbstract
{
    public function transform(User $user) {
        return [
            'id' => $user->id,
            'uuid' => $user->uuid,
            'type' => $user->getType(),
            'status' => $user->getStatus(),
            'item_report_banned' => (bool)$user->item_report_banned,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'middle_name' => $user->middle_name,
            'display_name' => $user->display_name,
            'nationality' => $user->nationality,
            'phone' => $user->phone,
            'photo' => $user->photo,
            'gender' => $user->gender,
            'birth_date' => $user->birth_date,
            'created_date' => $user->birth_date,
            'last_modified' => $user->birth_date,
        ];
    }
}