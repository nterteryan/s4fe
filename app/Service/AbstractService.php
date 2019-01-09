<?php

namespace App\Service;

use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRestService
 * @package App\Service
 */
abstract class AbstractService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * AbstractRestService constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $relations
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(array $relations = [])
    {
        return $this->repository->with($relations)->findBy();
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function getByEmail(string $email)
    {
        return $this->repository->findOneBy(compact('email'));
    }

    /**
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function getById(int $id, array $relations = [])
    {
        return $this->repository->with($relations)->findOne($id);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->save($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createMultiple(array $data): bool
    {
        return $this->repository->saveMultiple($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data)
    {
        return $this->repository->update($model, $data);
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model)
    {
        return $this->repository->delete($model);
    }

    /**
     * @param string $table
     * @param string $conditions
     * @return RepositoryInterface instace
     */
    public function join($table, $conditions)
    {
        return $this->repository->join($table, $conditions);
    }
}