<?php

namespace App\Services;

use App\Repositories\TestimonialRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TestimonialService extends BaseService
{
    public function __construct(TestimonialRepository $repository)
    {
        parent::__construct($repository);
    }

    public function clearCache(): void
    {
        Cache::tags(['Testimonial'])->flush();
    }
}
