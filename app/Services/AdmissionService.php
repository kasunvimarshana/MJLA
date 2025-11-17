<?php

namespace App\Services;

use App\Repositories\AdmissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdmissionService extends BaseService
{
    public function __construct(AdmissionRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['Admission'])->flush();
    }
}
