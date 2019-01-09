<?php

namespace App\Service;

use App\Transformer\Item\ItemReportCommentTransformer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\Item\Report\Comment\ItemReportCommentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ItemReportCommentService
 * @package App\Service
 */
class ItemReportCommentService extends AbstractService
{
    /**
     * @var ItemReportService
     */
    protected $itemReportService;

    /**
     * @var ItemReportCommentTransformer
     */
    protected $itemReportCommentTransformer;

    /**
     * ItemReportCommentService constructor.
     * @param ItemReportService $itemReportService
     * @param ItemReportCommentRepositoryInterface $repository
     */
    public function __construct(
        ItemReportService $itemReportService,
        ItemReportCommentRepositoryInterface $repository
    ) {
        parent::__construct($repository);
        $this->itemReportService = $itemReportService;
        $this->itemReportCommentTransformer = new ItemReportCommentTransformer;
    }

    /**
     * @param int $reportId
     * @param int|null $commentId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getReportComments(int $reportId, int $commentId = null)
    {
        $criteria = ['report_id' => $reportId];
        if (null !== $commentId) {
            $criteria['parent_id'] = $commentId;
        }
        return $this->repository->with(['user', 'report'])->findBy($criteria);
    }

    /**
     * @param array|Collection|LengthAwarePaginator $comments
     * @param int|null $commentId
     * @return array
     */
    public function getReportCommentsTree($comments, int $commentId = null)
    {
        $branch = array();

        foreach ($comments as &$element) {
            $clone = clone $element;
            $element = $this->itemReportCommentTransformer->transform($element);
            if ($clone->parent_id == $commentId) {
                $children = $this->getReportCommentsTree($comments, $clone->id);
                if ($children) {
                    $element['related_comments'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addCommentToReport(array $data)
    {
        if (!$this->itemReportService->getById($data['report_id'])) {
            throw new ModelNotFoundException('Report with id ' . $data['report_id'] . ' not found');
        }

        $data['user_id'] = \Auth::id();
        $data['created_date'] = Carbon::now()->toDateTimeString();

        return $this->create($data);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addCommentToComment(array $data)
    {
        if (!$this->repository->findOne($data['parent_id'])) {
            throw new ModelNotFoundException('Comment with id ' . $data['parent_id'] . ' not found');
        }

        $data['user_id'] = \Auth::id();
        $data['created_date'] = Carbon::now()->toDateTimeString();

        return $this->create($data);
    }
}