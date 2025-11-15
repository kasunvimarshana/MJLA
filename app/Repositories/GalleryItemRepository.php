<?php

namespace App\Repositories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Collection;

class GalleryItemRepository extends BaseRepository
{
    public function __construct(GalleryItem $model)
    {
        parent::__construct($model);
    }

    public function getPublished(): Collection
    {
        return $this->model->published()->orderBy('order')->get();
    }

    public function getFeatured(): Collection
    {
        return $this->model->published()->featured()->orderBy('order')->get();
    }

    public function getByCategory(string $category): Collection
    {
        return $this->model->published()->category($category)->orderBy('order')->get();
    }

    public function getImages(): Collection
    {
        return $this->model->published()->images()->orderBy('order')->get();
    }

    public function getVideos(): Collection
    {
        return $this->model->published()->videos()->orderBy('order')->get();
    }
}
