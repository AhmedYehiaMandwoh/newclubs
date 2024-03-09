<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;
use App\Services\BouncerService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    // Users Main Links

    public function getMainRoute(): array
    {
        return [
            ['label' => __('base.home'), 'icon' => 'pi-home', 'href' => \route('home'), 'active' => Route::current()->getName() == 'home'],
        ];
    }

    public function getModuleRoutes(): array
    {
        $current_route_name = Route::currentRouteName();
        $response = [];
        if (BouncerService::checkAbility(Abilities::M_USERS_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS), 'icon' => 'pi-users', 'href' => \route('users.index'), 'active' => Str::startsWith($current_route_name, 'users.') || Str::startsWith($current_route_name, 'roles.')];
        $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::hospitality_providers), 'icon' => 'pi-building', 'href' => \route('hospitalityproviders.index'), 'active' => Str::startsWith($current_route_name, 'hospitalityproviders.')];
        $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CLIENTS), 'icon' => 'pi-users', 'href' => \route('clients.index'), 'active' => Str::startsWith($current_route_name, 'clients.')];
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::WITHDRAWS), 'icon' => 'pi-wallet', 'href' => \route('withdraws.index'), 'active' => Str::startsWith($current_route_name, 'withdraws.')];
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SPONSORS), 'icon' => 'pi-sitemap', 'href' => \route('sponsors.index'), 'active' => Str::startsWith($current_route_name, 'sponsors.')];
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::OFFERS), 'icon' => 'pi-gift', 'href' => \route('offers.index'), 'active' => Str::startsWith($current_route_name, 'offers.')];
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SETTINGS), 'icon' => 'pi-cog', 'href' => \route('settings.index'), 'active' => Str::startsWith($current_route_name, 'settings.')];
        return $response;
    }

    public function getMenu(): array
    {
        return [...$this->getMainRoute(), ...$this->getModuleRoutes()];
    }


    // hospitality_providers Main Links
    public function getHospitalityProvidersMenu(): array
    {
        $current_route_name = Route::currentRouteName();

        return [
            ['label' => __('base.home'), 'icon' => 'pi-home', 'href' => \route('hospitality_providers.homeHospitalityProviders'), 'active' => Route::current()->getName() == 'hospitality_providers.homeHospitalityProviders'],
            ['label' => __('base.branches'), 'icon' => 'pi-building', 'href' => \route('hospitality_providers.branches.index'), 'active' => Str::startsWith($current_route_name, 'hospitality_providers.branches')],
        ];
    }



    public function getMenuHospitalityProviders(): array
    {
        return [...$this->getHospitalityProvidersMenu()];
    }
}
