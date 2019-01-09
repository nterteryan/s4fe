<?php

namespace App\Repository\Item;

use App\Repository\RepositoryInterface;

/**
 * Interface ItemRepositoryInterface
 * @package App\Repository\Item
 */
interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $query
     * @return mixed
     */
    public function findMatchItems(string $query);
}