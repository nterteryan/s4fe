<?php

namespace App\Transformer\Item;

use App\Model\ItemReport;
use App\Model\ItemReportComment;
use League\Fractal\TransformerAbstract;

/**
 * Class ItemReportCommentTransformer
 * @package App\Transformer\Item
 */
class ItemReportCommentTransformer extends TransformerAbstract
{
    /**
     * @param ItemReportComment $itemReportComment
     * @return array
     */
    public function transform(ItemReportComment $itemReportComment)
    {
        return [
            'id' => $itemReportComment->id,
            'comment' => $itemReportComment->comment,
            'commenter' => $itemReportComment->getUser(),
            'report' => $itemReportComment->getReport()
        ];
    }
}