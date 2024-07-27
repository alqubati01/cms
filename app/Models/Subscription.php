<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'active_until',
        'user_id',
        'plan_id'
    ];

//    protected $dates = [
//        'active_until',
//    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive()
    {
//        return $this->active_until->gt(now());
        $first = Carbon::create($this->active_untile);
        return ! $first->gt(now());
    }

    public function scopeFilter($query)
    {
        if (request('search_text')) {
            $query->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search_text') . '%');
                });
        }

        return $query;
    }
}
