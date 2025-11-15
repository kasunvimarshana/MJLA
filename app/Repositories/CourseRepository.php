<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository extends BaseRepository
{
    /**
     * CourseRepository constructor.
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    /**
     * Get active courses
     */
    public function getActive(): Collection
    {
        return $this->model->active()->orderBy('order')->get();
    }

    /**
     * Get featured courses
     */
    public function getFeatured(): Collection
    {
        return $this->model->active()->featured()->orderBy('order')->get();
    }

    /**
     * Get courses by level
     */
    public function getByLevel(string $level): Collection
    {
        return $this->model->active()->level($level)->orderBy('order')->get();
    }

    /**
     * Find course by slug
     */
    public function findBySlug(string $slug): ?Course
    {
        return $this->model->where('slug', $slug)->first();
    }
}
