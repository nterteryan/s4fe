<?php

namespace App\Http\Controllers;

use App\Service\SearchService;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    use RestResponseTrait;

    /**
     * @var ItemService
     */
    protected $searchService;

    /**
     * SearchController constructor.
     * @param ItemService $itemService
     * @param ItemTransformer $itemTransformer
     */
    public function __construct(SearchService $searchService)
    {
        parent::__construct();
        $this->searchService = $searchService;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function search(string $query, $filters=null)
    {
        try {
            $items = $this->searchService->searchItems($query, $filters);
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data'    => $items,
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }
}