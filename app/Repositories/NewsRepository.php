<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsRepository extends BaseRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function getPublished(): Collection
    {
        return $this->model->published()->orderBy('published_at', 'desc')->get();
    }

    public function getFeatured(): Collection
    {
        return $this->model->published()->featured()->orderBy('published_at', 'desc')->get();
    }

    public function getByCategory(string $category): Collection
    {
        return $this->model->published()->category($category)->orderBy('published_at', 'desc')->get();
    }

    public function getEvents(): Collection
    {
        return $this->model->published()->events()->orderBy('event_date')->get();
    }

    public function findBySlug(string $slug): ?News
    {
        return $this->model->where('slug', $slug)->first();
    }
}
