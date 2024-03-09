<?php

namespace App\Models;

use App\Services\StorageService;
use App\Traits\{ModelDateTextTrait, MorphModelTriggerTrait, SearchTrait};
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property int $id
 */
class Withdraw extends BaseModel
{
    use MorphModelTriggerTrait, SearchTrait,
        ModelDateTextTrait;

    protected $fillable = [
        'name', 'avatar', 'started_at', 'ended_at'
    ];
    protected $appends = [
        'avatar_url',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];
    protected $casts = [
        'started_at' => 'date:Y-m-d',
        'ended_at' => 'date:Y-m-d',
    ];

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->avatar ? StorageService::publicUrl($this->avatar) : asset('images/no-image.png');
            },
        );
    }
}
