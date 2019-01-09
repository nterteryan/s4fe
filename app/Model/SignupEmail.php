<?php
namespace App\Model;

class SignupEmail extends AbstractModel
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
