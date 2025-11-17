<?php

namespace App\Services;

use App\Repositories\VisaServiceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
