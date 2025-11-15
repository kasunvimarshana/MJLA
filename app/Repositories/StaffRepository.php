<?php

namespace App\Repositories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class StaffRepository extends BaseRepository
{
    public function __construct(Staff $model)
    {
        parent::__construct($model);
    }

    public function getActive(): Collection
    {
        return $this->model->active()->orderBy('order')->get();
    }

    public function getFeatured(): Collection
    {
        return $this->model->active()->featured()->orderBy('order')->get();
    }

    public function getByDepartment(string $department): Collection
    {
        return $this->model->active()->department($department)->orderBy('order')->get();
    }

    public function findBySlug(string $slug): ?Staff
    {
        return $this->model->where('slug', $slug)->first();
    }
}
