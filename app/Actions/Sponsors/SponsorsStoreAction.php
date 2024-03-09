<?php

namespace App\Actions\Sponsors;

use App\Classes\{Abilities, BaseAction};
use App\Enums\StoragePathEnum;
use App\Http\Requests\SponsorRequest;
use App\Models\Sponsor;
use App\Services\StorageService;

class SponsorsStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_CREATE;

    public function handle(SponsorRequest $request)
    {

        $validated_data = $request->validated();
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::SPONSORS, $request->file('avatar'));
        }
        Sponsor::query()->create($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}


