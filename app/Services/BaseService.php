<?php

namespace App\Services;

use App\Services\Contracts\ServiceInterface;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

abstract class BaseService implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    /**
     * Cache time in seconds (default: 1 hour)
     *
     * @var int
     */
    protected int $cacheTime = 3600;

    /**
     * BaseService constructor.
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all records
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('all'),
            $this->cacheTime,
            fn() => $this->repository->all()
        );
    }

    /**
     * Get paginated records
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get record by ID
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        return Cache::remember(
            $this->getCacheKey("find.{$id}"),
            $this->cacheTime,
            fn() => $this->repository->find($id)
        );
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $model = $this->repository->create($data);
            $this->clearCache();
            return $model;
        });
    }

    /**
     * Update a record
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        return DB::transaction(function () use ($id, $data) {
            $model = $this->repository->update($id, $data);
            $this->clearCache();
            return $model;
        });
    }

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $result = $this->repository->delete($id);
            $this->clearCache();
            return $result;
        });
    }

    /**
     * Get cache key
     *
     * @param string $suffix
     * @return string
     */
    protected function getCacheKey(string $suffix): string
    {
        return strtolower(class_basename($this)) . ".{$suffix}";
    }

    /**
     * Clear all cache for this service
     *
     * @return void
     */
    protected function clearCache(): void
    {
        Cache::tags([strtolower(class_basename($this))])->flush();
    }
}
