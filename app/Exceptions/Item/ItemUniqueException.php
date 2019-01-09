<?php

namespace App\Exceptions\Item;

/**
 * Class ItemUniqueException
 * @package App\Exceptions\Item
 */
class ItemUniqueException extends ItemException
{
    const UNIQUE_BY_MESSAGE = 'Item with %s %s already exists.';
}