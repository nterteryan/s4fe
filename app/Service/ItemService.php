<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use App\Model\Item;
use App\Model\ItemReport;
use App\Model\ItemPhoto;
use App\Repository\Item\ItemRepositoryInterface;
use Carbon\Carbon;

use App\Model\User;
use App\Model\ItemStatus;
use App\Helpers\BlockChainHelper;
use Exception;

/**
 * Class ItemService
 * @package App\Service
 * @property ItemRepositoryInterface $repository
 */
class ItemService extends AbstractService
{
    /**
     * @var FileService
     */
    protected $model, $baseDir = 'uploads/item';

    /**
     * @var FileService
     */
    protected $fileUploadService;
    /**
     *
     * @var ItemReport 
     */
    protected $itemReportModel;

    /**
     * @var ItemPhotoService
     */
    protected $itemPhotoService;

    /**
     * ItemService constructor.
     * @param ItemRepositoryInterface $repository
     * @param FileService $fileUploadService
     * @param ItemPhotoService $itemPhotoService
     */
    public function __construct(
        Item $model,
        ItemRepositoryInterface $repository,
        FileService $fileUploadService,
        ItemPhotoService $itemPhotoService,
        ItemReport $itemReportModel
    )
    {
        parent::__construct($repository);
        $this->model = $model;
        $this->itemReportModel = $itemReportModel;
        $this->fileUploadService = $fileUploadService;
        $this->itemPhotoService = $itemPhotoService;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function create(array $data)
    {
        try {
            \DB::beginTransaction();
            $data = array_merge($data, [
                'user_id' => \Auth::id(),
                'created_date' => Carbon::now()->toDateTimeString()
            ]);

            $createdItem = parent::create($data);

            if (!empty($data['photos'])) {
                $this->saveItemPhotos($createdItem, $data['photos']);
            }

            if(env('BLOCKCHAIN_API'))
            {
                $sender = User::find($data['user_id']);
                if(!$sender->walletAddress) {
                    throw new Exception ("Wallet is not created for your account. Please setup wallet first for ".$sender->email);
                }

                if(isset($data['transfer_ownership'])) {
                    $owner = User::find($data['transfer_ownership']);
                    if(!$owner->walletAddress) {
                        throw new Exception ("Wallet is not created for ownership user. Please setup wallet first for ".$owner->email);
                    }   
                }

                $data = [
                    'account' => isset($owner) ? $owner->walletAddress : $sender->walletAddress,
                    'article' => 0,
                    'category' => $data['category_id'],
                    'serialNumber' => $data['serial_number'],
                    'status' => $data['status_id'],
                ];

                $response = BlockChainHelper::post('safe/contract/s4fe-item/add/', $data);
                if(isset($response) && $response['status'] == false) {
                    throw new Exception($response['message']);
                }
            }
            \DB::commit();
        } catch (\Throwable $exception) {
            \DB::rollback();
            throw $exception;
        }
        return $createdItem;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function update(Model $item, array $data)
    {
        try {
            \DB::beginTransaction();
            $data = array_merge($data, [
                'user_id' => \Auth::id()
            ]);
            $updatedItem = parent::update($item, $data);
            if (!empty($data['photos'])) {
                $this->saveItemPhotos($updatedItem, $data['photos']);
            }
            if(env('BLOCKCHAIN_API'))
            {
                $sender = User::find($data['user_id']);
                if(!$sender->walletAddress) {
                    throw new Exception ("Wallet is not created for your account. Please setup wallet first for ".$sender->email);
                }

                if(isset($data['transfer_ownership'])) {
                    $owner = User::find($data['transfer_ownership']);
                    if(!$owner->walletAddress) {
                        throw new Exception ("Wallet is not created for ownership user. Please setup wallet first for ".$owner->email);
                    }   
                }

                    $data = [
                        'account' => isset($owner) ? $owner->walletAddress : $sender->walletAddress,
                        'article' => 0,
                        'category' => !empty($data['category_id'])?$data['category_id']:$item->category_id,
                        'serialNumber' => !empty($data['serial_number'])?$data['serial_number']:$item->serial_number,
                        'status' => !empty($data['status_id'])?$data['status_id']:$item->status_id,
                    ];
                $response = BlockChainHelper::post('safe/contract/s4fe-item/updateStatus/', $data);
                if(isset($response) && $response['status'] == false) {
                    throw new Exception($response['message']);
                }
            }

            \DB::commit();
        } catch (\Throwable $exception) {
            \DB::rollback();
            throw $exception;
        }

        return $updatedItem;
    }
    
    /**
     * Delete photo from dir and from itep_photos table
     * 
     * @param int $id Item id
     * @param string $photo file name
     * @return boolean
     * @throws Exception
     */
    public function deletePhoto($id, $photo)
    {
        if(!($item = Item::where([
            'user_id' => \Auth::id(),
            'id' => $id
        ])))
            throw new Exception ('This item does not exists !', 404);
        if(!ItemPhoto::where(['item_id'=>$id , 'file' => $photo])->delete())
            throw new Exception ('This file does not exist !', 404);
        if(!$this->fileUploadService->delete($this->baseDir.'/'.$photo))
            throw new Exception ('Something went wrong. Can not delete file', 500);
        return true;
    }
    
    /**
     * @param string $query
     * @return mixed
     */
    public function searchItems(string $query)
    {
        return $this->repository->findMatchItems($query);
    }

    /**
     * @param Item $createdItem
     * @param string ...$photos
     * @throws \Exception
     */
    private function saveItemPhotos(Item $createdItem, array $photos)
    {
        $itemPhotosArray = $this->fileUploadService->store($this->baseDir, $photos);
        $saveData = [];
        $date = Carbon::now()->toDateTimeString();
        foreach ($itemPhotosArray as $file) {
            $saveData[] = [
                'item_id' => $createdItem->id,
                'file' => $file,
                'name' => $file,
                'created_date' => $date
            ];
        }
        $this->itemPhotoService->createMultiple($saveData);
    }

    /**
     * @param array $conditions
     * @return Item
     */
    public function getAll(array $conditions = [])
    {
        $model = $this->model;
        foreach ($conditions as $field => $condition){
            $model = $model->where($field, $condition);
        }
        $total = $model->count();
        $limit = !empty($_GET['limit']) ? $_GET['limit']*1: $total;
        $offset = !empty($_GET['offset']) ? $_GET['offset']*1: 0;
        $items = $model
                ->offset($offset)
                ->limit($limit)
                ->get();
        return ['items' => $items, 'total' =>$total];
    }

    /**
     * Get items who sent report auth-user
     * 
     * @return Item
     */
    public function getReported()
    {
        $item_table   = $this->repository->getTable();
        $report_table = $this->itemReportModel->getTable();
        $items = parent::join($report_table, [
            'on' => [
                ["{$item_table}.id",        '=' , "{$report_table}.item_id"],
                ["{$report_table}.user_id", '!=' , "{$item_table}.user_id"]
            ]
        ])
        ->where([
            ["{$report_table}.user_id", '=' , \Auth::id()]
        ])
        ->select("{$item_table}.*")
        ->groupBy("{$item_table}.id")
        ->paginate(0, 1000);
        return $items;
    }
    
    /**
     * Get items having reports
     * 
     * @return Item
     */
    public function getFounded()
    {
        $item_table   = $this->repository->getTable();
        $report_table = $this->itemReportModel->getTable();
        $items = parent::join($report_table, [
            'on' => [
                ["{$item_table}.id",        '=' , "{$report_table}.item_id"],
                ["{$report_table}.user_id", '!=' , "{$item_table}.user_id"]
            ]
        ])
        ->where([
            ["{$item_table}.user_id", '=' , \Auth::id()]
        ])
        ->select("{$item_table}.*")
        ->groupBy("{$item_table}.id")
        ->paginate(0, 1000);
        return $items;
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
        foreach (ItemStatus::all() as $status)
        {
            if(in_array($status->name, $excepts))
                continue;
            $statuses[] = $status;
        }
        return $statuses;
    }
}