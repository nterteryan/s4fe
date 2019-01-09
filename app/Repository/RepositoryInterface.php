<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface RepositoryInterface
{
    /**
     * @param array $relations
     * @return RepositoryInterface
     */
    public function with(array $relations): RepositoryInterface;

    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @param string $id
     * @return Model
     */
    public function findOne(string $id): ?Model;

    /**
     * @param array $criteria
     * @return Model
     */
    public function findOneBy(array $criteria): ?Model;

    /**
     * @param array $searchCriteria
     * @return LengthAwarePaginator
     */
    public function findBy(array $searchCriteria = []): LengthAwarePaginator;

    /**
     * @param string $key
     * @param array $values
     * @return LengthAwarePaginator
     */
    public function findIn(string $key, array $values): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Model
     */
    public function save(array $data): Model;

    /**
     * @param array $data
     * @return bool
     */
    public function saveMultiple(array $data): bool;

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * delete a resource
     *
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);
    
    
    /**
     * Join model with table by conditions
     * 
     * @param string $table Table name
     * @param array $conditions join conditions
     */
//    public function join($table, $conditions);
}