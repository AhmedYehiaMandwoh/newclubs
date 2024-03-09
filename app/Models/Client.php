<?php

namespace App\Models;

use App\Services\StorageService;
use App\Traits\ModelDateTextTrait;
use App\Traits\MorphModelTriggerTrait;
use App\Traits\SearchTrait;
use App\Traits\SetPasswordTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, MorphModelTriggerTrait, SetPasswordTrait, SearchTrait,
        ModelDateTextTrait;

    protected $fillable = [
        'name', 'phone', 'email', 'avatar', 'password', 'is_active'
    ];

    protected $appends = [
        'avatar_url',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];


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
                return 'client';
            },
        );
    }
}
