<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'excerpt', 'content', 'status', 'published_at',
        'featured_image', 'featured_image_alt', 'is_featured', 'is_cornerstone', 'focus_keyphrase',
        'keyphrase_synonyms', 'seo_title', 'meta_description', 'canonical_url', 'robots_index',
        'robots_follow', 'og_title', 'og_description', 'og_image', 'twitter_title',
        'twitter_description', 'twitter_image', 'schema_type',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_cornerstone' => 'boolean',
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'blog_post_id', 'blog_tag_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function (Builder $visibility) {
                $visibility->where('status', 'published')->orWhere('status', 'scheduled');
            });
    }

    public function getReadingTimeAttribute(): int
    {
        $plainText = trim(strip_tags($this->content ?? ''));
        preg_match_all('/[\p{L}\p{N}]+/u', $plainText, $matches);
        $words = count($matches[0] ?? []);
        return max(1, (int) ceil($words / 200));
    }

    public function getSeoTitleAttribute($value): string
    {
        return $value ?: ($this->title ?? '');
    }

    public function getMetaDescriptionAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        if ($this->excerpt) {
            return (string) str($this->excerpt)->squish()->limit(155);
        }

        return (string) str(strip_tags($this->content ?? ''))->squish()->limit(155);
    }
}
