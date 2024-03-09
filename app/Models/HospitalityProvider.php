<?php

namespace App\Models;

use App\Enums\HospitalityProviderTypesEnum;
use App\Services\StorageService;
use App\Traits\ModelDateTextTrait;
use App\Traits\MorphModelTriggerTrait;
use App\Traits\SearchTrait;
use App\Traits\SetPasswordTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property boolean is_active
 * @property string name
 * @property string phone
 * @property string email
 * @property string avatar
 * @property-read string avatar_url
 * @property string main_color
 * @property string type
 * @property-read string type_text
 * @property string secondary_color
 * @property string third_color
 * @property-read Branch[] branches
 */
class HospitalityProvider extends Authenticatable

{
    use MorphModelTriggerTrait, SetPasswordTrait, SearchTrait, HasApiTokens,
        ModelDateTextTrait;

    protected $fillable = [
        'name', 'phone', 'email', 'avatar','is_active', 'password', 'main_color', 'type', 'secondary_color', 'third_color'
    ];

    protected $appends = [
        'type_text',
        'avatar_url', 'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function typeText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => HospitalityProviderTypesEnum::getTrans($this->type),
        );
    }

    public function branches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Branch::class);
    }
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->avatar ? StorageService::publicUrl($this->avatar) : asset('images/no-image.png');
            },
        );
    }


    protected function userType(): Attribute
    {
        return Attribute::make(
            get: function () {
                return 'hospitality_provider';
            },
        );
    }
}


