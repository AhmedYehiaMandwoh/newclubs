<?php

namespace App\Actions\Apis\ClientHospitality;

use App\Classes\{BaseAction};
use App\Http\Requests\Apis\ClientApiLoginRequest;
use App\Http\Resources\ClientProviderResource;
use App\Models\{Client, HospitalityProvider};
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClientHospitalityLoginAction extends BaseAction
{
    use ApiResponseTrait;

    public function handle(ClientApiLoginRequest $request)
    {
        $validated_data = $request->validated();
        $user = Client::query()
            ->where('email', $validated_data['email_or_phone'])
            ->orWhere('phone', $validated_data['email_or_phone'])->first();
        if (!$user) {
            $user = HospitalityProvider::where('email', $validated_data['email_or_phone'])->orWhere('phone', $validated_data['email_or_phone'])->first();

            if (!$user) {
                throw ValidationException::withMessages(['email_or_phone' => __('validation.email_or_phone')]);
            }
        }
        if (!$user || !Hash::check($validated_data['password'], $user->password)) {
            throw ValidationException::withMessages(['email_or_phone' => __('validation.email_or_phone')]);
        }
        $data['user'] = ClientProviderResource::make($user);
        $data['token'] = $user->createToken(get_class($user) == Client::class ? 'client-token' : 'hospitality-provider-token')->plainTextToken;
        return $this->apiResponseMobile(__('base.login_successfully'), $data);

    }
}
