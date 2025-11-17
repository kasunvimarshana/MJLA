<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationRequest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'visa_service_id',
        'name',
        'email',
        'phone',
        'visa_type',
        'preferred_date',
        'preferred_time',
        'message',
        'status',
        'meta',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'meta' => 'array',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the visa service associated with this consultation.
     */
    public function visaService(): BelongsTo
    {
        return $this->belongsTo(VisaService::class);
    }

    /**
     * Scope a query to only include pending requests.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include scheduled requests.
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }
}
