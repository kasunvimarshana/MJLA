<?php

namespace App\Services;

use App\Repositories\StaffRepository;
use Illuminate\Support\Facades\Cache;

class StaffService extends BaseService
{
    public function __construct(StaffRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['Staff'])->flush();
    }
}
