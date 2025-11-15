<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CourseService extends BaseService
{
    /**
     * CourseService constructor.
     *
     * @param CourseRepository $repository
     */
    public function __construct(CourseRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get active courses
     *
     * @return Collection
     */
    public function getActiveCourses(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('active'),
            $this->cacheTime,
            fn() => $this->repository->getActive()
        );
    }

    /**
     * Get featured courses
     *
     * @return Collection
     */
    public function getFeaturedCourses(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('featured'),
            $this->cacheTime,
            fn() => $this->repository->getFeatured()
        );
    }

    /**
     * Get courses by level
     *
     * @param string $level
     * @return Collection
     */
    public function getCoursesByLevel(string $level): Collection
    {
        return Cache::remember(
            $this->getCacheKey("level.{$level}"),
            $this->cacheTime,
            fn() => $this->repository->getByLevel($level)
        );
    }

    /**
     * Get course by slug
     *
     * @param string $slug
     * @return Course|null
     */
    public function getBySlug(string $slug): ?Course
    {
        return Cache::remember(
            $this->getCacheKey("slug.{$slug}"),
            $this->cacheTime,
            fn() => $this->repository->findBySlug($slug)
        );
    }
}
