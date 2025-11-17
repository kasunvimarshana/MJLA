<?php

namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends BaseRepository
{
    public function __construct(BlogPost $model)
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

    public function findBySlug(string $slug): ?BlogPost
    {
        return $this->model->where('slug', $slug)->first();
    }
}
