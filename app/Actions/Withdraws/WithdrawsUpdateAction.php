<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Enums\StoragePathEnum;
use App\Http\Requests\WithdrawRequest;
use App\Models\Withdraw;
use App\Services\StorageService;
use Carbon\Carbon;

class WithdrawsUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_UPDATE;

    public function handle(Withdraw $withdraw, WithdrawRequest $request)
    {
        $validated_data['started_at'] = Carbon::parse($request->started_at)->format('Y-m-d');
        $validated_data['ended_at'] = Carbon::parse($request->ended_at)->format('Y-m-d');
        $validated_data = $request->validated();
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::WITHDRAWS, $request->file('avatar'), oldFileToDeletePath: $withdraw->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $withdraw->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}
