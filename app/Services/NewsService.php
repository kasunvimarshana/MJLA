<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Cache;

class NewsService extends BaseService
{
    public function __construct(NewsRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['News'])->flush();
    }
}
