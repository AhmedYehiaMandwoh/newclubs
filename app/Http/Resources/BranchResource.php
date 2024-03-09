<?php

namespace App\Http\Resources;

use App\Classes\Helpmate;
use App\Http\Resources\Api\LandResource;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Branch
 * */
class BranchResource extends JsonResource
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'qr_url' => $this->qr_url,
            'time_of_work' => $this->time_of_work,
            ...($this->is_in_branch !== null ? ['is_in_branch' => Helpmate::updateBollenForApi($this->is_in_branch)] : []),
            ...($this->relationLoaded('hospitalityProvider') ? ['provider' => HospitalityProviderResource::make($this->hospitalityProvider)] : []),
        ];
    }
}
