<?php

namespace App\Http\Controllers;

use App\Service\CategoryService;
use Illuminate\Http\JsonResponse;

use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryService $categoryService
     */
    protected $categoryService;
    
    /**
     * UserController constructor.
     * @param UserService $userService
     * @param UserTransformer $userTransformer
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    /**
     * @return JsonResponse
     */
    public function index($id = null): JsonResponse
    {
        try {
            if($id)
            {
                $categories =  $this->categoryService->getByConditions(['parent_id' => null, 'id' => $id], false);
                if($categories)
                    $categories = [$categories->toArray()];
            } else{
                $categories =  $this->categoryService->getByConditions(['parent_id' => null]);
            }
            if(!$categories)
                throw new \Exception('Not Found.', 404);
            return $this->respondSuccess([
                'status' => 200,
                'message' => 'Success.',
                'data' => $categories
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public function subs($id): JsonResponse
    {
        try {
            $categories =  $this->categoryService->getByConditions(['parent_id' => $id])->toArray();
            if(!$categories)
                throw new \Exception('Not Found.', 404);
            return $this->respondSuccess([
                'status' => 200,
                'message' =>  'Success.',
                'data' => $categories
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

}