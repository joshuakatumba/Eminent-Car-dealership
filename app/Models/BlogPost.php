<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'author_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get tags as an array
     */
    public function getTagsArrayAttribute()
    {
        if (empty($this->tags)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Set tags from array
     */
    public function setTagsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['tags'] = implode(',', array_map('trim', $value));
        } else {
            $this->attributes['tags'] = $value;
        }
    }

    /**
     * Scope to filter by tag
     */
    public function scopeWithTag($query, $tag)
    {
        return $query->where('tags', 'like', '%' . $tag . '%');
    }

    /**
     * Get all unique tags from all published posts
     */
    public static function getAllTags()
    {
        return static::where('status', 'published')
            ->whereNotNull('published_at')
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(function ($tags) {
                return array_map('trim', explode(',', $tags));
            })
            ->filter()
            ->unique()
            ->values();
    }

    /**
     * Get tag counts for tag cloud
     */
    public static function getTagCounts()
    {
        $tags = static::where('status', 'published')
            ->whereNotNull('published_at')
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(function ($tags) {
                return array_map('trim', explode(',', $tags));
            })
            ->filter();

        return $tags->countBy()->sortDesc();
    }

    /**
     * Get the full URL for the featured image
     */
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            return $this->featured_image;
        }

        // If it starts with /storage/, it's a relative path
        if (str_starts_with($this->featured_image, '/storage/')) {
            return asset($this->featured_image);
        }

        // Otherwise, assume it's a relative path
        return asset('storage/' . $this->featured_image);
    }
}
