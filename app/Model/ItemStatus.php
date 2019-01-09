<?php

namespace App\Model;

/**
 * Class ItemStatus
 * @package App\Model
 */
class ItemStatus extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'item_statuses';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'created_date',
        'updated_date'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_date','updated_date'
    ];
}
