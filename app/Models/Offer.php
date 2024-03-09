<?php

namespace App\Models;


use App\Models\Builders\OfferBuilder;
use App\Enums\OfferCanUseTypeEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Enums\OfferValidToTypeEnum;
use App\Services\StorageService;
use App\Traits\{MorphModelTriggerTrait};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property int $id
 * @property int branch_id
 * @property-read Branch $branch
 * @property string name
 * @property string icon
 * @property-read string icon_url
 * @property string discount_type
 * @property-read string discount_type_text
 * @property double discount_percent
 * @property double show_percent
 * @property string can_use_type
 * @property-read string can_use_type_text
 * @property Carbon can_use_from_date
 * @property string valid_to_type
 * @property-read string valid_to_type_text
 * @property-read string valid_to_date_text
 * @property Carbon valid_to_date
 * @property int max_used
 * @property int count_used
 */
class Offer extends BaseModel
{
    use MorphModelTriggerTrait;

    protected $fillable = [
        'branch_id', 'name', 'icon','discount_type', 'discount_percent', 'show_percent', 'can_use_type',
        'can_use_from_date', 'valid_to_type', 'valid_to_date', 'max_used', 'count_used',
    ];

    protected $appends = [
        'icon_url','discount_type_text','can_use_type_text','valid_to_type_text',
        'valid_to_date_text',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];

    protected $casts = [
        'valid_to_date' => 'date:Y-m-d',
        'discount_type' => OfferDiscountTypeEnum::class,
        'can_use_type' => OfferCanUseTypeEnum::class,
        'valid_to_type' => OfferValidToTypeEnum::class,
    ];

    public function getValidToDateTextAttribute(): ?string
    {
        return $this->valid_to_date?->format('Y-m-d');
    }
    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    protected function iconUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return StorageService::publicUrl($this->icon) ;
            },
        );
    }

    protected function discountTypeText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => OfferDiscountTypeEnum::getTrans($this->discount_type),
        );
    }
    protected function canUseTypeText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => OfferCanUseTypeEnum::getTrans($this->can_use_type),
        );
    }
    protected function validToTypeText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => OfferValidToTypeEnum::getTrans($this->valid_to_type),
        );
    }



    /**
     * @return OfferBuilder
     */
    public static function query(): OfferBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return OfferBuilder
     */
    public function newEloquentBuilder($query): OfferBuilder
    {
        return new OfferBuilder($query);
    }
}
