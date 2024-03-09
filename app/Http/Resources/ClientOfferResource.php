<?php

namespace App\Http\Resources;

use App\Models\ClientOffer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ClientOffer
*/
class ClientOfferResource extends JsonResource
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
            'expire_at' => $this->expire_at,
            'used_at' => $this->used_at,
            'status' => $this->status,
            'status_text' => $this->status_text,
            'allow_move' => $this->allow_move,
            'can_use' => $this->can_use,
            'allow_use_from_text' => $this->allow_use_from_text,
            ...($this->relationLoaded('offer')?['offer' => OfferResource::make($this->offer)]:[]),
            ...($this->relationLoaded('branch')?['branch' => BranchResource::make($this->branch)]:[]),

        ];
    }
}
