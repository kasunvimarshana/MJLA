<?php

namespace App\Services;

use App\Repositories\VisaServiceRepository;
use Illuminate\Support\Facades\Cache;

class VisaServiceService extends BaseService
{
    public function __construct(VisaServiceRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['VisaService'])->flush();
    }
}
