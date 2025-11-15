<?php

namespace App\Services;

use App\Repositories\StaffRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
