<?php

namespace App\Repositories;

use App\Models\VisaService;
use Illuminate\Database\Eloquent\Collection;

class VisaServiceRepository extends BaseRepository
{
    public function __construct(VisaService $model)
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

    public function getByCategory(string $category): Collection
    {
        return $this->model->active()->category($category)->orderBy('order')->get();
    }

    public function findBySlug(string $slug): ?VisaService
    {
        return $this->model->where('slug', $slug)->first();
    }
}
