<?php

namespace App\Models;


use App\Models\Builders\ClientOfferBuilder;
use App\Enums\ClientOfferStatusEnum;
use App\Traits\MorphModelTriggerTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int client_id
 * @property-read Client client
 * @property-read Client fromClient
 * @property int offer_id
 * @property-read Offer offer
 * @property int branch_id
 * @property-read Branch branch
 * @property Carbon expire_at
 * @property Carbon allow_use_form
 * @property-read string allow_use_from_text
 * @property Carbon used_at
 * @property-read ClientOfferStatusEnum status
 * @property-read string status_text
 * @property-read string allow_move
 * @property-read string can_use
 * @property int from_client_id
 */
class ClientOffer extends BaseModel
{
    use MorphModelTriggerTrait;

    protected $fillable = [
        'client_id', 'offer_id', 'branch_id', 'expire_at', 'allow_use_form', 'used_at',
        'from_client_id',
        'created_by_id', 'updated_by_id', 'deleted_by_id'
    ];

    protected $casts = [
        'allow_use_form' => 'date'
    ];
    protected $appends = ['allow_move', 'allow_use_from_text', 'can_use', 'status', 'status_text'];

    protected function allowUseFromText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->allow_use_form ? $this->allow_use_form->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
        );
    }

    protected function getCanUseAttribute(): bool
    {
        if (!$this->allow_move)
            return false;
        if ($this->allow_use_form && $this->allow_use_form > Carbon::now())
            return false;
        return true;
    }

    public function fromClient(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'from_client_id');
    }

    protected function allowMove(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => !in_array($this->status, [ClientOfferStatusEnum::USED, ClientOfferStatusEnum::ENDED]),
        );
    }


    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function getStatusAttribute(): ClientOfferStatusEnum
    {
        if ($this->used_at)
            return ClientOfferStatusEnum::USED;
        if ($this->expire_at < Carbon::now())
            return ClientOfferStatusEnum::ENDED;

        if ($this->created_at > Carbon::now()->subHour(24))
            return ClientOfferStatusEnum::NEW;
        return ClientOfferStatusEnum::SAVED;
    }

    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => ClientOfferStatusEnum::getTrans($this->status),
        );
    }

    /**
     * @return ClientOfferBuilder
     */
    public static function query(): ClientOfferBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return ClientOfferBuilder
     */
    public function newEloquentBuilder($query): ClientOfferBuilder
    {
        return new ClientOfferBuilder($query);
    }
}
