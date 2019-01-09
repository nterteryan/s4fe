<?php

namespace App\Model;

/**
 * Class UserType
 * @package App\Model
 */
class UserType extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'user_types';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}