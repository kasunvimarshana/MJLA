<?php

namespace App\Services;

use App\Repositories\LanguageProgramRepository;
use Illuminate\Support\Facades\Cache;

class LanguageProgramService extends BaseService
{
    public function __construct(LanguageProgramRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['LanguageProgram'])->flush();
    }
}
