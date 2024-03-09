<?php

namespace App\Models;

use App\Enums\SettingsKeysEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\{MorphModelTriggerTrait, SearchTrait, ModelDateTextTrait};

/**
 * @property int $id
 * @property string key
 * @property-read string key_text
 * @property string value
 */
class Setting extends BaseModel
{
    use MorphModelTriggerTrait;

    use MorphModelTriggerTrait, SearchTrait,
        ModelDateTextTrait;

    protected $fillable = [
        'key', 'value'
    ];
    protected $appends = [
        'key_text',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];
    protected $casts=[
        'key'=>SettingsKeysEnum::class
    ];

    protected function keyText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => SettingsKeysEnum::getTrans($this->key),
        );
    }
}
