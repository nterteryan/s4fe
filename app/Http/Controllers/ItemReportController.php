<?php

namespace App\Http\Controllers;

use App\Model\ItemReport;
use Illuminate\Http\Request;
use App\Service\ItemService;
use App\Service\ItemReportService;
use App\Transformer\Item\ItemReportTransformer;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class ItemReportController
 * @package App\Http\Controllers
 */
class ItemReportController extends Controller
{
    /**
     * @var ItemReportService
     */
    protected $itemReportService;

    /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * @var ItemReportTransformer
     */
    protected $itemReportTransformer;

    /**
     * ItemReportController constructor.
     * @param ItemReportService $itemReportService
     * @param ItemService $itemService
     * @param ItemReportTransformer $itemReportTransformer
     */
    public function __construct(
        ItemReportService $itemReportService,
        ItemService $itemService,
        ItemReportTransformer $itemReportTransformer
    ) {
        parent::__construct();
        $this->itemReportService = $itemReportService;
        $this->itemService = $itemService;
        $this->itemReportTransformer = $itemReportTransformer;
    }

    /**
     * @param int $itemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($itemId)
    {
        try {
            if (!($item = $this->itemService->getById($itemId))) {
                throw new \Exception('Item with ID ' . $itemId . ' not found', 404);
            }
            $users = $this->itemReportService->getItemReports($itemId);
            
            $data = $this->getWithCollection($users, $this->itemReportTransformer)['data'];
            return $this->respondSuccess([
                'status' => 200,
                'message' => 'Success.',
                'count' => count($data),
                'total' => count($data),
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function one($id)
    {
        try {
            $report = $this->itemReportService->getById($id);
            if (!$report) {
                throw new \Exception(sprintf('Report with id %s not found', $id), 404);
            }
            $report = $this->getWithItem($report, $this->itemReportTransformer)['data'];
            return $this->respondSuccess([
                'status' => 200,
                'message' => 'Success.',
                'data' => $report,
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param int $itemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, int $itemId)
    {
        try {
            $this->authorize('add-report-to-item');
            $item = $this->itemService->getById($itemId);
            if (!$item) {
                throw new \Exception('Item with ID ' . $itemId . ' not found', 404);
            }

            $request->merge(['item_id' => $itemId]);
            $validator = $this->doValidate($request);

            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            \DB::beginTransaction();
            $itemReport = $this->itemReportService->create($request->all());
            if (!$itemReport instanceof ItemReport) {
                throw new \Exception('Error occurred on creating Report', 500);
            }
            $report = $this->getWithItem($itemReport, $this->itemReportTransformer)['data'];
            \DB::commit();
            return $this->respondSuccess([
                'status' => 200,
                'message' => 'Success.',
                'data' => $report,
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }
    /**
     * Get item report statuses
     * 
     * @return JsonResponse
     */
    public function getStatuses()
    {
        try {
            $statuses = $this->itemReportService->getStatuses(['available', 'aproved']);
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data' => $statuses,
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
    /**
     * @param Request $request
     * @return mixed
     */
    protected function doValidate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'text' => 'required',
            'photos' => 'array',
        ]);

        return $validator;
    }
}