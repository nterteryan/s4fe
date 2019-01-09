<?php

namespace App\Model;

/**
 * Class UserStatus
 * @package App\Model
 */
class UserStatus extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'user_statuses';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id','created_date','updated_date'
    ];
}