<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemReportComment;
use Illuminate\Http\JsonResponse;
use App\Service\ItemReportCommentService;
use Illuminate\Auth\Access\AuthorizationException;
use App\Transformer\Item\ItemReportCommentTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ItemReportCommentController
 * @package App\Http\Controllers
 */
class ItemReportCommentController extends Controller
{
    /**
     * @var ItemReportCommentService
     */
    protected $itemReportCommentService;

    /**
     * @var ItemReportCommentTransformer
     */
    protected $itemReportCommentTransformer;

    /**
     * ItemReportCommentController constructor.
     * @param ItemReportCommentService $itemReportCommentService
     * @param ItemReportCommentTransformer $itemReportCommentTransformer
     */
    public function __construct(
        ItemReportCommentService $itemReportCommentService,
        ItemReportCommentTransformer $itemReportCommentTransformer
    )
    {
        parent::__construct();
        $this->itemReportCommentService = $itemReportCommentService;
        $this->itemReportCommentTransformer = $itemReportCommentTransformer;
    }

    /**
     * @param int $reportId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $reportId)
    {
        try {
            $comments = $this->itemReportCommentService->getReportCommentsTree(
                $this->itemReportCommentService->getReportComments($reportId)
            );
        } catch (\Throwable $exception) {
            \Log::critical('Get item report (id:' . $reportId . ') comments', ['exception' => $exception->getMessage()]);
            return $this->sendInternalServerErrorResponse();
        }

        if (!count($comments)) {
            return $this->sendEmptyDataResponse();
        }

        return $this->respondWithArray($comments);
    }

    /**
     * @param Request $request
     * @param int $reportId
     * @return JsonResponse
     */
    public function store(Request $request, int $reportId): JsonResponse
    {
        try {
            $this->authorize('add-report-to-item');
            $request->merge(['report_id' => $reportId]);
            $validator = $this->doValidate($request);

            if ($validator->fails()) {
                return $this->sendInvalidFieldResponse($validator->errors());
            }

            $comment = $this->itemReportCommentService->addCommentToReport($request->all());
            if (!$comment instanceof ItemReportComment) {
                return $this->sendInternalServerErrorResponse('Error occurred during Report comment creation');
            }
            return $this->setStatusCode(self::REST_CREATED)->respondWithItem($comment, $this->itemReportCommentTransformer);
        } catch (AuthorizationException $exception) {
            return $this->sendForbiddenResponse('No Permission: You have item report banned status');
        } catch (ModelNotFoundException $exception) {
            return $this->sendNotFoundResponse($exception->getMessage());
        } catch (\Throwable $exception) {
            \Log::critical('Cant store report comment: ', ['exception' => $exception->getMessage()]);
            return $this->sendInternalServerErrorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function doValidate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'report_id' => 'required|exists:reports,id',
            'comment' => 'required|string|max:500'
        ]);

        return $validator;
    }
}