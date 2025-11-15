<?php

namespace App\Services;

use App\Repositories\LanguageProgramRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
