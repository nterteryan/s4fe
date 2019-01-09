<?php
namespace App\Model;

class SignupPhone extends AbstractModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'hash',
        'verified',
    ];
}
