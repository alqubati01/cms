<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statues(): BelongsTo
    {
        return $this->belongsTo(Statuse::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeFilter($query)
    {
        if (request('type') && request('id')) {
            if (request('type') === 'post') {
                $query->where('commentable_type', 'App\Models\Post')
                    ->where('commentable_id', request('id'));
            }
        }
        if (request('statues_id')) {
            $query->where('statues_id', request('statues_id'));
        }
        if (request('search_text')) {
            $query->where('content', 'like', '%' . request('search_text') . '%')
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search_text') . '%');
                });
        }

        return $query;
    }
}
