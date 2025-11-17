<?php

namespace App\Services;

use App\Repositories\TestimonialRepository;
use Illuminate\Support\Facades\Cache;

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
