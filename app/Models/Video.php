<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'content',
        'statues_id',
        'visibility',
        'user_id',
        'category_id',
        'featured',
        'meta_title',
        'meta_description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statues(): BelongsTo
    {
        return $this->belongsTo(Statuse::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function scopeFilter($query)
    {
        if (request('statues_id')) {
            $query->where('statues_id', request('statues_id'));
        }
//        if (request('visibility')) {
//            $query->where('visibility', request('visibility'));
//        }
        if (request('category_id')) {
            $query->where('category_id', request('category_id'));
        }
        if (request('search_text')) {
//            $query->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", request('search_text'));
            $query->where('title', 'like', '%' . request('search_text') . '%')
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search_text') . '%');
                });
        }

        return $query;
    }
}
