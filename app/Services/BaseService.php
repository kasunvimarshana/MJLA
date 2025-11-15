<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

abstract class BaseService implements ServiceInterface
{
    protected RepositoryInterface $repository;

    /**
     * Cache time in seconds (default: 1 hour)
     */
    protected int $cacheTime = 3600;

    /**
     * BaseService constructor.
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all records
     */
    public function getAll(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('all'),
            $this->cacheTime,
            fn () => $this->repository->all()
        );
    }

    /**
     * Get paginated records
     */
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get record by ID
     */
    public function getById(int $id): ?Model
    {
        return Cache::remember(
            $this->getCacheKey("find.{$id}"),
            $this->cacheTime,
            fn () => $this->repository->find($id)
        );
    }

    /**
     * Create a new record
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
     */
    protected function getCacheKey(string $suffix): string
    {
        return strtolower(class_basename($this)).".{$suffix}";
    }

    /**
     * Clear all cache for this service
     */
    protected function clearCache(): void
    {
        Cache::tags([strtolower(class_basename($this))])->flush();
    }
}
