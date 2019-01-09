<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{
    Model, Builder
};

/**
 * Class AbstractEloquentRepository
 * @package App\Repository
 */
abstract class AbstractEloquentRepository implements RepositoryInterface
{
    const PER_PAGE_LIMIT = 20;
    const FIND_KEY = 'id';

    /**
     * @var Model $model
     */
    protected $model;

    /**
     * AbstractEloquentRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get model table name
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
    }
    /**
     * @param array $relations
     * @return RepositoryInterface
     */
    public function with(array $relations): RepositoryInterface
    {
        $this->model->with($relations);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @inheritdoc
     */
    public function findOne(string $id): ?Model
    {
        return $this->findOneBy([static::FIND_KEY => $id]);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria): ?Model
    {
        return $this->model->where($criteria)->first();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = []): LengthAwarePaginator
    {
        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : static::PER_PAGE_LIMIT;

        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function findIn(string $key, array $values): LengthAwarePaginator
    {
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * @inheritdoc
     */
    public function save(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function saveMultiple(array $data): bool
    {
        return (bool)$this->model->insert($data);
    }

    /**
     * @inheritdoc
     */
    public function update(Model $model, array $data): Model
    {
        $fillAbleProperties = $this->model->getFillable();

        foreach ($data as $key => $value) {
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        $model->save();

        $model = $this->findOne($model->id);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * @param $queryBuilder
     * @param array $searchCriteria
     * @return Builder
     */
    protected function applySearchCriteriaInQueryBuilder($queryBuilder, array $searchCriteria = []): Builder
    {

        foreach ($searchCriteria as $key => $value) {

            if (in_array($key, ['page', 'per_page'])) {
                continue;
            }

            $allValues = explode(',', $value);

            if (count($allValues) > 1) {
                $queryBuilder->whereIn($key, $allValues);
            } else {
                $operator = '=';
                $queryBuilder->where($key, $operator, $value);
            }
        }

        return $queryBuilder;
    }

    /**
     * @param string $table
     * @return RepositoryInterface instace
     */
    public function join($table, array $conditions = [])
    {
        return $this->model->join($table, function($query) use($conditions) {
            foreach($conditions as $filter => $condition)
            {
                $query->{$filter}($condition);
            }
        });
    }
}