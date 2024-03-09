<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\{Helpmate};
use App\Classes\BaseAction;
use App\Models\{Branch,};
use App\Models\Offer;
use Inertia\Inertia;

class BranchesProfileAction extends BaseAction
{

    public function viewMainData(Branch $branch): \Inertia\Response
    {
        abort_if(Helpmate::getAuthHospitalityProvider()?->id != $branch->hospitality_provider_id, 404);
        $this->setProfileTab('MainDataTab', $branch);
        $data['row'] = $branch;
        return Inertia::render('HospitalityProviders/Branches/Profile/Index', compact('data'));
    }

    public function viewEdit(Branch $branch): \Inertia\Response
    {
        $this->setProfileTab('EditTab', $branch, __('base.edit'));
        $data = BranchIndexAction::make()->getCreateUpdateData();
        $data['row'] = $branch;
        return Inertia::render('HospitalityProviders/Branches/Profile/Index', compact('data'));
    }

    public function viewOffers(Branch $branch): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->setProfileTab('TabOffersData', $branch, __('base.edit'));
        $query = Offer::query()->where('branch_id', $branch->id)->search(['name', 'email']);
        if ($this->requestIsExportWithoutAbility('export_excel')) {
            return $this->exportExcel(
                $query->get(),
                [
                    'branch_id',
                    "name",
                    "avatar",
                    "offer_type",
                    "discount",
                    "show_percent",
                    "can_use_type",
                    "can_use_type_date",
                    "valid_to_date",
                    "valid_to_type",
                    "valid_to_date",
                    "is_active",
                    "max_used",
                    "count_used",
                    "created_at_text",
                ]
                ,
                'offers'

            );
        }
        $data = $query->paginate($this->getPaginateLength());
        $form_data = BranchIndexAction::make()->getCreateUpdateData();
        $branch_id = $branch->id;
        return Inertia::render('HospitalityProviders/Branches/Profile/Index', compact('data', 'form_data', 'branch_id'));

    }


    public function setProfileTab($tap_component, Branch &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('hospitality_providers.branches.profile.main-data', $row)];

        if ($title) {
            BranchIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            BranchIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $row->append('qr_image');
        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
