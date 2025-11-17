<?php

namespace App\Repositories;

use App\Models\LanguageProgram;
use Illuminate\Database\Eloquent\Collection;

class LanguageProgramRepository extends BaseRepository
{
    public function __construct(LanguageProgram $model)
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

    public function getByLevel(string $level): Collection
    {
        return $this->model->active()->level($level)->orderBy('order')->get();
    }

    public function findBySlug(string $slug): ?LanguageProgram
    {
        return $this->model->where('slug', $slug)->first();
    }
}
