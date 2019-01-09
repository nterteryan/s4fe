<?php
namespace App\Model;

class ResetPassword extends AbstractModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'hesh'
    ];
}
