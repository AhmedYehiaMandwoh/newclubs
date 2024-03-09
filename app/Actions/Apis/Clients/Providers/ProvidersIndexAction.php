<?php

namespace App\Actions\Apis\Clients\Providers;

use App\Classes\BaseAction;
use App\Enums\HospitalityProviderTypesEnum;
use App\Http\Resources\BranchResource;
use App\Http\Resources\HospitalityProviderResource;
use App\Models\Branch;
use App\Models\HospitalityProvider;
use Lorisleiva\Actions\ActionRequest;

class ProvidersIndexAction extends BaseAction
{
    public function handle(ActionRequest $request)
    {
        $branches=Branch::query()
            ->withWhereHas('hospitalityProvider',fn($z)=>$z->where('is_active',true)->when($i=data_get($request,'type'),fn($z)=>$z->where('type',$i)))
            ->inRandomOrder()
            ->paginate();
        $branches->getCollection()->each(function ($item) {
            $item->is_in_branch =rand(0,1) == 1;
        });
        //to do sor by lat , long
        return $this->apiSuccess([
            'branches'=>BranchResource::collection($branches)->response()->getData(true)
        ]);
    }

    public function getFilterData(): \Illuminate\Http\JsonResponse
    {
        return $this->apiSuccess([
            'types'=>HospitalityProviderTypesEnum::getOptionsData(),
        ]);
    }
}
