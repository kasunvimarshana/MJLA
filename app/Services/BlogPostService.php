<?php

namespace App\Services;

use App\Repositories\BlogPostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BlogPostService extends BaseService
{
    public function __construct(BlogPostRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['BlogPost'])->flush();
    }
}
