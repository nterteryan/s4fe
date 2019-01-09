<?php

namespace App\Service;

use App\Repository\Item\Photo\ItemPhotoRepositoryInterface;

/**
 * Class ItemPhotoService
 * @package App\Service
 */
class ItemPhotoService extends AbstractService
{
    /**
     * ItemPhotoService constructor.
     * @param ItemPhotoRepositoryInterface $repository
     */
    public function __construct(ItemPhotoRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}