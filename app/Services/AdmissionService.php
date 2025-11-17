<?php

namespace App\Services;

use App\Repositories\AdmissionRepository;
use Illuminate\Support\Facades\Cache;

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
