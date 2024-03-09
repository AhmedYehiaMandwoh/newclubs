<?php

namespace App\Actions\Offers;


use App\Classes\{BaseAction, Abilities};
use App\Enums\{ModuleNameEnum, IsActiveEnum, OfferValidToTypeEnum, OfferCanUseTypeEnum, OfferDiscountTypeEnum};
use App\Models\Offer;
use Inertia\Inertia;

class OffersIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_OFFERS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Offer::query()->latest('id')->search(['name']);
        if ($this->requestIsExport(Abilities::M_OFFERS_INDEX_EXPORT)) {
            return $this->exportExcel(
                $query->get(),
                [
                    'branch_id',
                    "name",
                    "icon",
                    "offer_type",
                    "discount",
                    "show_percent",
                    "can_use_type",
                    "can_use_from_date",
                    "valid_to_type",
                    "valid_to_date",
                    "max_used",
                    "count_used",
                    "created_at_text",
                ]
                ,
                'offers'

            );
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Offers/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {

        return [
            'form_data' => [
                'valid_to_type' => OfferValidToTypeEnum::getOptionsData(),
                'can_use_type' => OfferCanUseTypeEnum::getOptionsData(),
                'discount_type' => OfferDiscountTypeEnum::getOptionsData(),
            ]
        ];
    }
    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::OFFERS), 'url' => route('offers.index')],
            ...$append_breadcrumb
        ]);
    }


}
