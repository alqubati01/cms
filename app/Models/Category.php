<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function podcasts(): HasMany
    {
        return $this->hasMany(Podcast::class);
    }

    public function scopeFilter($query)
    {
        if (request('search_text')) {
            $query->where('name', 'like', '%' . request('search_text') . '%');
        }

        return $query;
    }
}
