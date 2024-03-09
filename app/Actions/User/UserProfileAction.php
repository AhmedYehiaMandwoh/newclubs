<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Exceptions\NotAuthorizedException;
use App\Models\User;
use Inertia\Inertia;

class UserProfileAction extends BaseAction
{
    /**
     * @throws NotAuthorizedException
     */
    public function viewMainData(User $user): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_USERS_MAIN_DATA);
        $this->setProfileTab('MainDataTab', $user);
        $all_abilities = Abilities::getAbilities();

        $user->load('roles.abilities');
        $role_abilities = @$user->roles->first()->abilities ? $user->roles->first()->abilities->pluck('name')->toArray() : [];

        $custom_abilities = array_diff($all_abilities->pluck('key')->toArray(), $role_abilities);
        $custom_abilities = $all_abilities->whereIn('key', $custom_abilities)->groupBy('alias');

        $user_abilities = $user->getAbilities()->pluck('name')->toArray();
        $data['custom_abilities'] = $custom_abilities;

        $data['active_custom_abilities'] = array_values(array_diff($user_abilities, $role_abilities));
        $data['active_custom_abilities_module'] = $all_abilities->whereIn('key', $data['active_custom_abilities'])->groupBy('alias');

        $data['current_role_abilities'] = $all_abilities->whereIn('key', $role_abilities)->groupBy('alias');
        $data['row'] = $user;
        return Inertia::render('User/Profile/Index', compact('data'));
    }

    /**
     * @throws NotAuthorizedException
     */
    public function viewEdit(User $user): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_USERS_UPDATE);
        $this->setProfileTab('EditTab', $user, __('base.edit'));
        $data = UserIndexAction::make()->getCreateUpdateData();
        $user['role_name'] = @$user->roles[0]['name'];
        $data['row'] = $user;
        return Inertia::render('User/Profile/Index', compact('data'));
    }


    public function setProfileTab($tap_component, User &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('users.profile.main-data', $row)];

        if ($title) {
            UserIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            UserIndexAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
