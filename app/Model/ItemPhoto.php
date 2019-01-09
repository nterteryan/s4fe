<?php

namespace App\Model;

/**
 * Class ItemPhoto
 * @package App\Model
 */
class ItemPhoto extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'item_photos';

    /**
     * @var array
     */
    protected $fillable = [
        'item_id',
        'file',
    ];
}