<?php

namespace App\Http\Resources;

use App\Models\HospitalityProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin HospitalityProvider
*/
class HospitalityProviderResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar_url' => $this->avatar_url,
            'main_color' => $this->main_color,
            'secondary_color' => $this->secondary_color,
            'third_color' => $this->third_color,
            'type' => $this->type,
            'type_text' => $this->type_text,
        ];
    }
}
