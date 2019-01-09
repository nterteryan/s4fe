<?php

namespace App\Repository\Category;

use App\Repository\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryEloquentRepository
 * @package App\Repository\Category
 */
class CategoryEloquentRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    /**
     * CategoryEloquentRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}