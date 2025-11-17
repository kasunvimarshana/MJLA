<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
