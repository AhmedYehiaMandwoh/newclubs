<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Enums\StoragePathEnum;
use App\Http\Requests\WithdrawRequest;
use App\Models\Withdraw;
use App\Services\StorageService;

class WithdrawsStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_CREATE;

    public function handle(WithdrawRequest $request)
    {
        $validated_data = $request->validated();
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::WITHDRAWS, $request->file('avatar'));
        }
        Withdraw::query()->create($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}


