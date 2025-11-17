<?php

namespace App\Services;

use App\Repositories\GalleryItemRepository;
use Illuminate\Support\Facades\Cache;

class GalleryItemService extends BaseService
{
    public function __construct(GalleryItemRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['GalleryItem'])->flush();
    }
}
