<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CourseService extends BaseService
{
    /**
     * CourseService constructor.
     */
    public function __construct(CourseRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get active courses
     */
    public function getActiveCourses(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('active'),
            $this->cacheTime,
            fn () => $this->repository->getActive()
        );
    }

    /**
     * Get featured courses
     */
    public function getFeaturedCourses(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('featured'),
            $this->cacheTime,
            fn () => $this->repository->getFeatured()
        );
    }

    /**
     * Get courses by level
     */
    public function getCoursesByLevel(string $level): Collection
    {
        return Cache::remember(
            $this->getCacheKey("level.{$level}"),
            $this->cacheTime,
            fn () => $this->repository->getByLevel($level)
        );
    }

    /**
     * Get course by slug
     */
    public function getBySlug(string $slug): ?Course
    {
        return Cache::remember(
            $this->getCacheKey("slug.{$slug}"),
            $this->cacheTime,
            fn () => $this->repository->findBySlug($slug)
        );
    }
}
