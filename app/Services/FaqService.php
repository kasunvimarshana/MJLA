<?php

namespace App\Services;

use App\Repositories\FaqRepository;
use Illuminate\Support\Facades\Cache;

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
