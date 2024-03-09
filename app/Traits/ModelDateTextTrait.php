<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * @property-read string|null created_at_text
 * @property-read string|null created_at
 * @property-read string|null updated_at
 * @property-read string|null updated_at_text
 * @property-read string|null deleted_at
 * @property-read string|null deleted_at_text
 */
trait ModelDateTextTrait
{
    //for update date created_at and updated_at format
    public function getCreatedAtTextAttribute(): ?string
    {
        return $this->getDate($this->created_at);
    }

    public function getUpdatedAtTextAttribute(): ?string
    {
        return $this->getDate($this->updated_at);
    }

    public function getDeletedAtTextAttribute(): ?string
    {
        return $this->getDate($this->deleted_at);
    }

    private function getDate($date): ?string
    {
        if (!$date) {
            return '- - - -';
        }
        $carbon = Carbon::parse($date);
        if ($carbon->diffInHours() < 24) {
            return $carbon->diffForHumans();
        }

        if ($carbon->diffInDays() < 7) {
            return $carbon->format('Y-m-d');
        }

        return $carbon->format('Y-m-d h:i A');
    }
}
