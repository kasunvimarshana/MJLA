<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;

class TestimonialRepository extends BaseRepository
{
    public function __construct(Testimonial $model)
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
}
