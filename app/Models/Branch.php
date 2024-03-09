<?php

namespace App\Models;

use App\Classes\Helpmate;
use App\Services\StorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\{BaseModel, Offer};
use App\Traits\{MorphModelTriggerTrait, SearchTrait, ModelDateTextTrait};
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * @property int $id
 * @property int hospitality_provider_id
 * @property string name
 * @property string time_of_work
 * @property string is_active
 * @property string latitude
 * @property string longitude
 * @property string address
 * @property-read HospitalityProvider hospitalityProvider
 * @property-read string qr_url
 * @property-read string qr_image
 *
 */
class Branch extends BaseModel
{
    use MorphModelTriggerTrait, SearchTrait,
        ModelDateTextTrait;

    protected $fillable = [
        'time_of_work',
        'hospitality_provider_id', 'name', 'is_active', 'latitude', 'longitude', 'address'
    ];

    public function hospitalityProvider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HospitalityProvider::class);
    }

    protected $appends = [
        'qr_url',
        'created_at_text', 'updated_at_text', 'deleted_at_text'
    ];

    protected function qrUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => route('branch.open_qr',$this)
        );
    }
    protected function qrImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Helpmate::createQrFormText($this->qr_url);
            },
        );
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'branch_id');
    }

}
