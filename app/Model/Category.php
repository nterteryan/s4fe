<?php

namespace App\Model;

/**
 * Class Category
 * @package App\Model
 */
class Category extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
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
