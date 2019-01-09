<?php

namespace App\Transformer\Item;

use App\Model\ItemReport;
use League\Fractal\TransformerAbstract;

/**
 * Class ItemReportTransformer
 * @package App\Transformer\Item
 */
class ItemReportTransformer extends TransformerAbstract
{
    /**
     * @param ItemReport $itemReport
     * @return array
     */
    public function transform(ItemReport $itemReport)
    {
        return [
            'id' => $itemReport->id,
            'text' => $itemReport->text,
            'website' => $itemReport->website,
            'reporter' => $itemReport->getUser(),
            'item' => $itemReport->getItem(),
            'status' => $itemReport->getStatus(),
            'photos' => $this->buildReportPhotos($itemReport->photos),
        ];
    }
    
    /**
     * @param Collection $photos
     * @return Collection
     */
    protected function buildReportPhotos($photos)
    {
        foreach ($photos as &$photo) {
            $file = $photo['file'];
            $photo['file'] = url('uploads/report/' . $file);
            $photo['name'] = $file;
        }
        return $photos;
    }
}