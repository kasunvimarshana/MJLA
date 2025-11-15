<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqRepository extends BaseRepository
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function getPublished(): Collection
    {
        return $this->model->published()->orderBy('order')->get();
    }

    public function getByCategory(string $category): Collection
    {
        return $this->model->published()->category($category)->orderBy('order')->get();
    }
}
