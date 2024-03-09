<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\StorageService;
use App\Traits\MorphModelTriggerTrait;
use App\Traits\SearchTrait;
use App\Traits\SetPasswordTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\ModelDateTextTrait;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string avatar
 * @property Carbon email_verified_at
 * @property bool is_active
 * @property-read string avatar_url
 */
class User extends Authenticatable
{
    use HasRolesAndAbilities;
    use HasApiTokens, HasFactory, Notifiable, SetPasswordTrait;
    use ModelDateTextTrait, MorphModelTriggerTrait, SearchTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password', 'is_active'
    ];

    protected $appends = [
        'avatar_url',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->avatar ? StorageService::publicUrl($this->avatar) : asset('images/user-avatar.png');
            },
        );
    }
}
