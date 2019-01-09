<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

use Illuminate\Support\Facades\Log;

/**
 * Trait RestResponseTrait
 * @package App\Http\Controllers
 */
trait RestResponseTrait
{
    /**
     * @var
     */
    protected $fractal;

    /**
     * @param Manager $fractal
     */
    public function setFractal(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @param Integer $status
     * @param string $data
     * @return JsonResponse
     */
    public function respondException($data, $status): JsonResponse
    {
        if(!$status or $status < 0 or $status >= 527)
            $status = 500;
        $array = [
            'status' => $status,
            'message' => $data,
        ];
        if($status == 400)
        {
            $data = json_decode($data);
            if(json_last_error())
            {
                $status = 500;
                $array['status']   = 500;
                $array['message']  = 'Json parse error: '.json_last_error_msg();
                $array['response'] = $data;
                $data = [];
            }
            foreach($data as $type => $errors)
            {
                $array['message'] = $type;
                $array['errors'] = $errors;
            }
        }
        if(env('APP_ENV') === 'prod' and $status >= 500)
        {
            print_r($data);
            exit;
            $array = [
                'status' => $status,
                'message' => 'Server error.',
            ];
            Log::critical($e->getMessage());
        }
        
        return response()->json($array, $status);
    }

    /**
     * @param array $result
     * @return JsonResponse
     */
    public function respondSuccess(array $result):JsonResponse
    {
        if(empty($result['status']))
            return $this->respondException ('Status-code is not passed', 500);
        if(empty($result['data']))
            $result['data'] = [];
        return response()->json($result, $result['status']);
    }

    /**
     * @param $collection
     * @param $callback
     * @return array
     */
    protected function getWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        //set empty data pagination
        if (empty($collection)) {
            $collection = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            $resource = new Collection($collection, $callback);
        }
//        $resource->setPaginator(new IlluminatePaginatorAdapter($collection));
        $rootScope = $this->fractal->createData($resource);
        return $rootScope->toArray();
    }

    /**
     * @param $item
     * @param $callback
     * @return array
     */
    protected function getWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $rootScope->toArray();
    }
}