<?php

namespace App\Services;

use App\Repositories\FaqRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FaqService extends BaseService
{
    public function __construct(FaqRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['Faq'])->flush();
    }
}
