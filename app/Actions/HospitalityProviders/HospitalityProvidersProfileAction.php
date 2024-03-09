<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\{HospitalityProviderTypesEnum, IsActiveEnum};
use App\Exceptions\NotAuthorizedException;
use App\Models\{Branch, HospitalityProvider,};
use Inertia\Inertia;

class HospitalityProvidersProfileAction extends BaseAction
{
    /**
     * @throws NotAuthorizedException
     */
    public function viewMainData(HospitalityProvider $hospitalityprovider): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_HospitalityProviders_MAIN_DATA);
        $this->setProfileTab('MainDataTab', $hospitalityprovider);


        $data['row'] = $hospitalityprovider;
        return Inertia::render('Managment/Profile/Index', compact('data'));
    }

    /**
     * @throws NotAuthorizedException
     */
    public function viewEdit(HospitalityProvider $hospitalityprovider): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_HospitalityProviders_UPDATE);
        $this->setProfileTab('EditTab', $hospitalityprovider, __('base.edit'));
        $data = HospitalityProvidersIndexAction::make()->getCreateUpdateData();
        $data['row'] = $hospitalityprovider;

        return Inertia::render('Managment/Profile/Index', compact('data'));
    }

    public function viewBranches(HospitalityProvider $hospitalityprovider): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->checkAbility(Abilities::M_HospitalityProviders_BRANCHES);

        $this->setProfileTab('TabBranchesData', $hospitalityprovider, __('base.branches'));
        $query = Branch::query()->where('hospitality_provider_id', $hospitalityprovider->id)->search(['name', 'email']);
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Managment/Profile/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }


    public function getCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'is_active' => IsActiveEnum::getOptionsData(),
                'types' => HospitalityProviderTypesEnum::getOptionsData(),
            ]
        ];
    }

    public function setProfileTab($tap_component, HospitalityProvider &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('hospitalityproviders.profile.main-data', $row)];

        if ($title) {
            HospitalityProvidersIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            HospitalityProvidersIndexAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
