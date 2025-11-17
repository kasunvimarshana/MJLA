<?php

namespace App\Repositories;

use App\Models\Admission;
use Illuminate\Database\Eloquent\Collection;

class AdmissionRepository extends BaseRepository
{
    public function __construct(Admission $model)
    {
        parent::__construct($model);
    }

    public function getPending(): Collection
    {
        return $this->model->pending()->orderBy('submitted_at', 'desc')->get();
    }

    public function getApproved(): Collection
    {
        return $this->model->approved()->orderBy('submitted_at', 'desc')->get();
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model->status($status)->orderBy('submitted_at', 'desc')->get();
    }

    public function findByReference(string $reference): ?Admission
    {
        return $this->model->where('reference_number', $reference)->first();
    }
}
