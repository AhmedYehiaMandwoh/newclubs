<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read User $createdBy
 * @property-read int $created_by_id
 */
trait UserModelCreateTriggerTrait
{
    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    protected static function booting(): void
    {
        self::adminModelTrigger();
    }

    protected static function adminModelTrigger(): void
    {
        static::creating(function ($row) {
            $row->created_by_id = Auth::id();
        });
    }
}

