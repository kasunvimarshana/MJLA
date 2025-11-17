<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Admission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'nationality',
        'address',
        'course_id',
        'language_program_id',
        'education_level',
        'japanese_level',
        'motivation',
        'status',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'admin_notes',
        'documents',
        'meta',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'documents' => 'array',
        'meta' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($admission) {
            if (empty($admission->reference_number)) {
                $admission->reference_number = 'ADM-' . strtoupper(Str::random(8));
            }
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function languageProgram()
    {
        return $this->belongsTo(LanguageProgram::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeEnrolled($query)
    {
        return $query->where('status', 'enrolled');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
