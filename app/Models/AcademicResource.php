<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicResource extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $fillable = [
        'department_id', 'uploader_id', 'uploader_name', 'title', 'slug', 'subject', 'course_code',
        'semester', 'category', 'description', 'file_path', 'file_name', 'mime_type', 'file_size',
        'cover_image', 'page_count', 'rating_average', 'rating_count', 'downloads_count',
        'is_verified', 'is_featured', 'status', 'moderation_note', 'approved_by', 'approved_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean', 'is_featured' => 'boolean',
        'approved_at' => 'datetime', 'rating_average' => 'decimal:2',
    ];

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(AcademicDepartment::class, 'department_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ResourceReview::class, 'academic_resource_id')->latest();
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'resource_bookmarks', 'academic_resource_id', 'user_id')->withTimestamps();
    }
}
