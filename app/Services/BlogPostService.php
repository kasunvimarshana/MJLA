<?php

namespace App\Services;

use App\Repositories\BlogPostRepository;
use Illuminate\Support\Facades\Cache;

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
