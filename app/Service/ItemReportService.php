<?php

namespace App\Service;

use App\Repository\Item\Report\ItemReportRepositoryInterface;
use App\Model\ItemReport;
use App\Model\ReportPhoto;
use App\Model\ItemReportStatus;

use App\Service\FileService;

use Carbon\Carbon;

/**
 * Class ItemReportService
 * @package App\Service
 */
class ItemReportService extends AbstractService
{
    private $model, $fileService, $baseDir = 'uploads'.DIRECTORY_SEPARATOR.'report';
    /**
     * ItemReportService constructor.
     * @param ItemReportRepositoryInterface $repository
     */
    public function __construct (
            ItemReportRepositoryInterface $repository,
            ItemReport $model,
            FileService $fileService
        )
    {
        parent::__construct($repository);
        $this->model = $model;
        $this->fileService = $fileService;
    }

    /**
     * @param int $itemId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getItemReports($itemId)
    {
//        $model = $this->model->where(['item_id' => $itemId]);
        return $this->repository->findBy(['item_id' => $itemId]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $data['user_id'] = \Auth::id();
        $data['status_id'] = 1;
        $data['created_date'] = Carbon::now()->toDateTimeString();
        if(!$created_report = parent::create($data))
            throw new \Exception("Something went wrong.Can't create report",500);
        if (!empty($data['photos'])) {
            $files = $this->fileService->store($this->baseDir, $data['photos']);
            foreach($files as $file)
            {
                $report_photo = [
                    'report_id' => $created_report->id,
                    'file' => $file,
                    'name' => $file
                ];
                ReportPhoto::create($report_photo);
            }
        }
        return $created_report;
    }

    /**
     * Get Item Statuses
     *
     * @param array $excepts
     * @return type
     */
    public function getStatuses(array $excepts = [])
    {
        $statuses = [];
        foreach (ItemReportStatus::all() as $status)
        {
            if(in_array($status->name, $excepts))
                continue;
            $statuses[] = $status;
        }
        return $statuses;
    }
}