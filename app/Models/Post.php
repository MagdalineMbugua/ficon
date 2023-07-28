<?php

namespace App\Models;

use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    use HasUserStamp;
    use Searchable;

    protected $guarded = [];
    protected $casts = ['on_sale' => 'boolean'];
    protected $with = ['media'];

    public const ELASTIC_FIELD_SEARCH=[
      'caption',
      'created_by'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function saved_posts(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ['saved_posts', 'user_id', 'post_id']);
    }

    public function shouldBeSearchable(): bool
    {
        return count($this->toSearchableArray()) > 0;
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    public function searchableWith(): array
    {
        return ['media'];
    }
}
