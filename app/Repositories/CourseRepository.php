<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository extends BaseRepository
{
    /**
     * CourseRepository constructor.
     *
     * @param Course $model
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    /**
     * Get active courses
     *
     * @return Collection
     */
    public function getActive(): Collection
    {
        return $this->model->active()->orderBy('order')->get();
    }

    /**
     * Get featured courses
     *
     * @return Collection
     */
    public function getFeatured(): Collection
    {
        return $this->model->active()->featured()->orderBy('order')->get();
    }

    /**
     * Get courses by level
     *
     * @param string $level
     * @return Collection
     */
    public function getByLevel(string $level): Collection
    {
        return $this->model->active()->level($level)->orderBy('order')->get();
    }

    /**
     * Find course by slug
     *
     * @param string $slug
     * @return Course|null
     */
    public function findBySlug(string $slug): ?Course
    {
        return $this->model->where('slug', $slug)->first();
    }
}
