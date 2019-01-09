<?php

namespace App\Repository\Item;

use App\Repository\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemEloquentRepository
 * @package App\Repository\Item
 */
class ItemEloquentRepository extends AbstractEloquentRepository implements ItemRepositoryInterface
{
    /**
     * ItemEloquentRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function findMatchItems(string $query)
    {
        $this->model = $this->model->search($query);
        return $this->findBy();
    }
}