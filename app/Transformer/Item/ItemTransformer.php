<?php

namespace App\Transformer\Item;

use App\Model\Item;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class ItemTransformer
 * @package App\Transformer\Item
 */
class ItemTransformer extends TransformerAbstract
{
    /**
     * @param Item $item
     * @return array
     */
    public function transform(Item $item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'reward' => $item->reward,
            'description' => $item->description,
            'serial_number' => $item->serial_number,
            'owner' => $item->getUser(),
            'status' => $item->getStatus(),
            'category' => $item->getCategory(),
            'transform_ownership' => $item->getTransferOwnership(),
            'photos' => $this->buildItemPhotos($item->getPhotos())
        ];
    }

    /**
     * @param Collection $photos
     * @return Collection
     */
    protected function buildItemPhotos(Collection $photos): Collection
    {
        if (!$photos->count()) {
            return new Collection;
        }
        foreach ($photos as &$photo) {
            $file = $photo['file'];
            $photo['file'] = url('uploads/item/' . $file);
            $photo['name'] = $file;
        }
        return $photos;
    }
}