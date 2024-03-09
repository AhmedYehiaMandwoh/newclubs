<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\BaseAction;
use App\Enums\{IsActiveEnum, ModuleNameEnum, OfferCanUseTypeEnum, OfferValidToTypeEnum, OfferDiscountTypeEnum};
use App\Models\{Branch,};
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BranchIndexAction extends BaseAction
{

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Branch::query()->where('hospitality_provider_id', Auth::guard('hospitality_provider')->user()->id)->latest('id')->search(['name']);
        if ($this->requestIsExportWithoutAbility('export_excel')) {
            return $this->exportExcel($query->get(), ['id', 'hospitality_provider_id', 'name', 'is_active', 'latitude', 'longitude', 'created_at_text'], 'hospitality_branches');
        }
        $data = $query->paginate($this->getPaginateLength());
        // dd($data['qrcode_image']);
        return Inertia::render('HospitalityProviders/Branches/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {


        return [
            'form_data' => [
                'valid_to_type' => OfferCanUseTypeEnum::getOptionsData(),
                'can_use_type' => OfferValidToTypeEnum::getOptionsData(),
                'discount_type' => OfferDiscountTypeEnum::getOptionsData(),
                'is_active' => IsActiveEnum::getOptionsData(),

            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BRANCHES), 'url' => route('hospitality_providers.branches.index')],
            ...$append_breadcrumb
        ]);
    }


}
