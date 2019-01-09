<?php

namespace App\Service;

use App\Model\Category;

/**
 * Class CategoryService
 * @package App\Service
 * @author Varazdat Stepanyan
 */
class CategoryService extends AbstractService
{
    private $model;
    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param array $conditions
     * @param int|boolean $id
     * @return Category model
     */
    public function getByConditions(array $conditions, $all = true)
    {
        $model = $this->model;
        foreach($conditions as $column => $condition)
        {
            $model = $model->where($column, $condition);
        }
        return $all 
                ? $model->get()
                : $model->first();
    }
}