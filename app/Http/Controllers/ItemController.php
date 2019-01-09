<?php

namespace App\Http\Controllers;

use App\Model\Item;
use App\Service\ItemService;
use App\Transformer\Item\ItemTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ItemController
 * @package App\Http\Controllers
 * @author Varazdat Stepanyan
 */
class ItemController extends Controller
{
    /**
     * @var ItemService
     */
    protected $itemService;
    /**
     * @var ItemTransformer
     */
    protected $itemTransformer;

    /**
     * ItemController constructor.
     * @param ItemService $itemService
     * @param ItemTransformer $itemTransformer
     */
    public function __construct(ItemService $itemService, ItemTransformer $itemTransformer)
    {
        parent::__construct();
        $this->itemService = $itemService;
        $this->itemTransformer = $itemTransformer;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $result = $this->itemService->getAll(['user_id' => \Auth::id()]);
            $data = [
                'status' => 200,
                'message'=> 'Success.',
                'count'  => count($result['items']),
                'total'  => $result['total'],
                'data'   => $this->getWithCollection($result['items'], $this->itemTransformer)['data'],
            ];
            return $this->respondSuccess($data);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
    
    /**
     * Get items which user sent report
     * 
     * @return JsonResponse
     */
    public function reported(): JsonResponse
    {
        try {
            $items = $this->itemService->getReported();
            $data = [
                'status'  => 200,
                'message' => count($items)? count($items).' reported items' : 'No reported items',
                'count'  => count($items),
                'total'  => count($items),
                'data'    => $this->getWithCollection($items, $this->itemTransformer)['data'],
            ];
            return $this->respondSuccess($data);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Get items who have reports
     * 
     * @return JsonResponse
     */
    public function founded(): JsonResponse
    {
        try {
            $items = $this->itemService->getFounded();
            $data = [
                'status'  => 200,
                'message' => count($items)? count($items).' founded items' : 'No founded items',
                'count'  => count($items),
                'total'  => count($items),
                'data'    => $this->getWithCollection($items, $this->itemTransformer)['data'],
            ];
            return $this->respondSuccess($data);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function one($id)
    {
        try {
            $item = $this->itemService->getById($id);

            if (!$item) {
                throw new \Exception(sprintf('Item with id %s not found', $id), 404);
            }

            $item = $this->getWithItem($item, $this->itemTransformer)['data'];
            $data = [
                'status'  => 200,
                'message' => 'Success.',
                'data'    => $item,
            ];
            return $this->respondSuccess($data);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = $this->doValidate($request);

            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            if (!($item = $this->itemService->create($request->all()))) {
                throw new \Exception("Something went wrong.Can't create item.", 500);
            }
            $item = $this->getWithItem($item, $this->itemTransformer)['data'];
            return $this->respondSuccess([
                'status' => 201,
                'message'=> 'Created.',
                'data'   => $item
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function put(int $id, Request $request)
    {
        try {
            $validator = $this->doValidate($request, $id);

            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            
            $item = $this->itemService->getById($id);
            if (!$item) {
                throw new \Exception(sprintf('Item with id %s not found', $id), 404);
            }
            $this->authorize('update-item', $item);
            $item = $this->itemService->update($item, $request->only('status_id', 'photos'));
            $item = $this->getWithItem($item, $this->itemTransformer)['data'];
            return $this->respondSuccess([
                'status' => 200,
                'message'=> 'Updated.',
                'data'   => $item
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|JsonResponse
     */
    public function patch(int $id, Request $request)
    {
        try {
            $item = $this->itemService->getById($id);

            if (!$item) {
                return $this->sendNotFoundResponse(sprintf('Item with id %s not found', $id));
            }

            $this->authorize('update-item', $item);

            $item = $this->itemService->update($item, $request->all());
            return $this->setStatusCode(self::REST_ACCEPTED)->respondWithItem($item, $this->itemTransformer);
        } catch (AuthorizationException $exception) {
            return $this->sendForbiddenResponse($exception->getMessage());
        }  catch (\Throwable $exception) {
            \Log::critical('Cant patch item: ', ['exception' => $exception->getMessage()]);
            return $this->sendInternalServerErrorResponse($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $item = $this->itemService->getById($id);

            if (!$item) {
                throw new \Exception(sprintf('Item with id %s not found', $id), 404);
            }
            $this->authorize('delete-item', $item);
            $item->delete();
            return $this->respondSuccess([
                'status' => 200,
                'message'=> 'Deleted.',
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete photo by item id and file name
     * 
     * @param int $item_id Item id
     * @param string $file_name file name
     * @return JsonResponse
     */
    public function delete_file($item_id, $file_name)
    {
        try {
            \DB::beginTransaction();
            $this->itemService->deletePhoto($item_id, $file_name);
            \DB::commit();
            return $this->respondSuccess([
                'status' => 200,
                'message'=> 'Deleted.',
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Get item statuses
     * 
     * @return JsonResponse
     */
    public function getStatuses()
    {
        try {
            $statuses = $this->itemService->getStatuses(['aproved']);
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
     * @return array
     */
    protected function doValidate(Request $request, $id=false)
    {
        $array = $request->all();
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'exists:item_statuses,id',
            'title' => 'required|max:160',
            'description' => '',
            'transfer_ownership' => 'exists:users,id',
            'reward' => '',
            'serial_number' => 'required|unique:items',
            'photos' => 'array'
        ];
        if($request->method() == 'PUT')
        {
            $array = $request->only('status_id');
            $rules = [
                'status_id' => 'exists:item_statuses,id',
                'photos' => 'array',
            ];
        }
        $validator = \Validator::make($array, $rules);
        return $validator;
    }
}