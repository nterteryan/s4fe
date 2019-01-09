<?php

namespace App\Repository\Item\Report;

use App\Model\ItemReport;
use App\Repository\AbstractEloquentRepository;

/**
 * Class ItemReportEloquentRepository
 * @package App\Repository\Item\Report
 */
class ItemReportEloquentRepository extends AbstractEloquentRepository implements ItemReportRepositoryInterface
{
    /**
     * ItemReportEloquentRepository constructor.
     * @param ItemReport $model
     */
    public function __construct(ItemReport $model)
    {
        parent::__construct($model);
    }
}