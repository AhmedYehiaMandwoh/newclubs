<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read User $deletedBy
 * @property-read int $deleted_by_id
 */
trait UserModelDeleteTriggerTrait
{
    use Prunable, SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }

    protected static function booting(): void
    {
        self::adminModelTrigger();
    }

    protected static function adminModelTrigger(): void
    {
        static::deleting(function ($row) {
            $row->update(['deleted_by_id' => Auth::id()]);
        });
    }

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable(): \Illuminate\Database\Eloquent\Builder
    {
        return static::onlyTrashed()->where('deleted_at', '<', now()->subDays(30));
    }
}

