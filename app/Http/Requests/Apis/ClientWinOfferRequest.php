<?php

namespace App\Http\Requests\Apis;

use App\Models\Role;
use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientWinOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        return [
            'offer_id' => 'required',

        ];
    }
}
