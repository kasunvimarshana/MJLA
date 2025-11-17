<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'company',
        'content',
        'photo',
        'rating',
        'course',
        'is_published',
        'is_featured',
        'order',
        'meta',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'meta' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
