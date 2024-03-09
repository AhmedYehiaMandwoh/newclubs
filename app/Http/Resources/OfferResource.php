<?php

namespace App\Http\Resources;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Offer
*/
class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon_url' => $this->icon_url,
            'discount_type' => $this->discount_type,
            'discount_type_text' => $this->discount_type_text,
            'discount_percent' => $this->discount_percent,
            'show_percent' => $this->show_percent,
            'can_use_type' => $this->can_use_type,
            'can_use_type_text' => $this->can_use_type_text,
            'can_use_from_date' => $this->can_use_from_date,
            'valid_to_type' => $this->valid_to_type,
            'valid_to_type_text' => $this->valid_to_type_text,
            'valid_to_date_text' => $this->valid_to_date_text,
            ...($this->relationLoaded('branch')?['branch' => BranchResource::make($this->branch)]:[]),
        ];
    }
}
