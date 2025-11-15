<?php

namespace App\Services;

use App\Repositories\GalleryItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
