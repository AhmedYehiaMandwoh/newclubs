<?php

namespace App\Traits;

use App\Classes\Helpmate;
use App\Models\User;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read User $createdBy
 * @property-read User $updatedBy
 * @property-read User $deletedBy
 * @property-read int $created_by_id
 * @property-read int $updated_by_id
 * @property-read int $deleted_by_id
 */
trait UserModelTriggerTrait
{
    use Prunable, SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

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
        static::creating(function ($row) {
            $row->created_by_id =Helpmate::getAuthUserId();
        });

        static::updating(function ($row) {
            $row->updated_by_id = Helpmate::getAuthUserId();
        });

        static::deleting(function ($row) {
            $row->update(['deleted_by_id' => Helpmate::getAuthUserId()]);
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

