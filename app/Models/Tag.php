<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps();
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable')->withTimestamps();
    }

    public function podcasts(): MorphToMany
    {
        return $this->morphedByMany(Podcast::class, 'taggable')->withTimestamps();
    }

    public function scopeFilter($query)
    {
        if (request('search_text')) {
            $query->where('name', 'like', '%' . request('search_text') . '%');
        }

        return $query;
    }
}
