<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;

enum Abilities: string
{
    //users
    case M_USERS_INDEX = 'm_users_index';
    case M_USERS_INDEX_EXPORT = 'm_users_index_export';
    case M_USERS_STORE = 'm_users_store';
    case M_USERS_UPDATE = 'm_users_update';
    case M_USERS_DELETE = 'm_users_delete';
    case M_USERS_MAIN_DATA = 'M_USERS_MAIN_DATA';
    case M_USERS_ADD_CUSTOM_ABILITY = 'M_USERS_ADD_CUSTOM_ABILITY';

    // WITHDRAWS
    case M_WITHDRAWS_INDEX = 'm_withdraws_index';
    case M_WITHDRAWS_INDEX_EXPORT = 'm_withdraws_index_export';
    case M_WITHDRAWS_CREATE = 'm_withdraws_create';
    case M_WITHDRAWS_UPDATE = 'm_withdraws_update';
    case M_WITHDRAWS_DELETE = 'm_withdraws_delete';
    case M_WITHDRAWS_MAIN_DATA = 'm_withdraws_main_data';

    // CLIENTS
    case M_CLIENTS_INDEX = 'm_clients_index';
    case M_CLIENTS_INDEX_EXPORT = 'm_clients_index_export';
    case M_CLIENTS_CREATE = 'm_clients_create';
    case M_CLIENTS_UPDATE = 'm_clients_update';
    case M_CLIENTS_DELETE = 'm_clients_delete';
    case M_CLIENTS_MAIN_DATA = 'm_clients_main_data';


    // SPONSORS
    case M_SPONSORS_INDEX = 'm_sponsors_index';
    case M_SPONSORS_INDEX_EXPORT = 'm_sponsors_index_export';
    case M_SPONSORS_CREATE = 'm_sponsors_create';
    case M_SPONSORS_UPDATE = 'm_sponsors_update';
    case M_SPONSORS_DELETE = 'm_sponsors_delete';
    case M_SPONSORS_MAIN_DATA = 'm_sponsors_main_data';

    // OFFERS
    case M_OFFERS_INDEX = 'm_offers_index';
    case M_OFFERS_INDEX_EXPORT = 'm_offers_index_export';
    case M_OFFERS_CREATE = 'm_offers_create';
    case M_OFFERS_UPDATE = 'm_offers_update';
    case M_OFFERS_DELETE = 'm_offers_delete';
    case M_OFFERS_MAIN_DATA = 'm_offers_main_data';
    // SETTINGS
    case M_SETTINGS_INDEX = 'm_settings_index';
    case M_SETTINGS_UPDATE = 'm_settings_update';

    //HospitalityProviders
    case M_HospitalityProviders_INDEX = 'm_hospitality_providers_index';
    case M_HospitalityProviders_INDEX_EXPORT = 'm_hospitality_providers_index_export';
    case M_HospitalityProviders_UPDATE = 'm_hospitality_providers_update';
    case M_HospitalityProviders_DELETE = 'm_hospitality_providers_delete';
    case M_HospitalityProviders_MAIN_DATA = 'm_hospitality_providers_main_data';

    case M_HospitalityProviders_BRANCHES = 'm_hospitality_providers_branches';


  //roles
    case M_ROLES_INDEX = 'm_roles_index';
    case M_ROLES_EXPORT = 'm_roles_export';
    case M_ROLES_DELETE = 'm_roles_delete';
    case M_ROLES_STORE = 'm_roles_store';
    case M_ROLES_UPDATE = 'M_ROLES_UPDATE';
    public const PERMISSIONS = [
        ['key' => self::M_USERS_INDEX, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_INDEX_EXPORT, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_STORE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_UPDATE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_MAIN_DATA, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_DELETE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_ADD_CUSTOM_ABILITY, 'module' => ModuleNameEnum::USERS],

        ['key' => self::M_HospitalityProviders_INDEX, 'module' => ModuleNameEnum::hospitality_providers],
        ['key' => self::M_HospitalityProviders_INDEX_EXPORT, 'module' => ModuleNameEnum::hospitality_providers],
        ['key' => self::M_HospitalityProviders_UPDATE, 'module' => ModuleNameEnum::hospitality_providers],
        ['key' => self::M_HospitalityProviders_DELETE, 'module' => ModuleNameEnum::hospitality_providers],
        ['key' => self::M_HospitalityProviders_MAIN_DATA, 'module' => ModuleNameEnum::hospitality_providers],

        ['key' => self::M_HospitalityProviders_BRANCHES, 'module' => ModuleNameEnum::hospitality_providers],


        ['key' => self::M_ROLES_INDEX, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_EXPORT, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_STORE, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_UPDATE, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_DELETE, 'module' => ModuleNameEnum::ROLES],

        ['key' => self::M_SPONSORS_INDEX, 'module' => ModuleNameEnum::SPONSORS],
        ['key' => self::M_SPONSORS_INDEX_EXPORT, 'module' => ModuleNameEnum::SPONSORS],
        ['key' => self::M_SPONSORS_CREATE, 'module' => ModuleNameEnum::SPONSORS],
        ['key' => self::M_SPONSORS_UPDATE, 'module' => ModuleNameEnum::SPONSORS],
        ['key' => self::M_SPONSORS_DELETE, 'module' => ModuleNameEnum::SPONSORS],
        ['key' => self::M_SPONSORS_MAIN_DATA, 'module' => ModuleNameEnum::SPONSORS],

        ['key' => self::M_OFFERS_INDEX, 'module' => ModuleNameEnum::OFFERS],
        ['key' => self::M_OFFERS_INDEX_EXPORT, 'module' => ModuleNameEnum::OFFERS],
        ['key' => self::M_OFFERS_CREATE, 'module' => ModuleNameEnum::OFFERS],
        ['key' => self::M_OFFERS_UPDATE, 'module' => ModuleNameEnum::OFFERS],
        ['key' => self::M_OFFERS_DELETE, 'module' => ModuleNameEnum::OFFERS],
        ['key' => self::M_OFFERS_MAIN_DATA, 'module' => ModuleNameEnum::OFFERS],

        ['key' => self::M_SETTINGS_INDEX, 'module' => ModuleNameEnum::SETTINGS],
        ['key' => self::M_SETTINGS_UPDATE, 'module' => ModuleNameEnum::SETTINGS],



        ['key' => self::M_WITHDRAWS_INDEX, 'module' => ModuleNameEnum::WITHDRAWS],
        ['key' => self::M_WITHDRAWS_INDEX_EXPORT, 'module' => ModuleNameEnum::WITHDRAWS],
        ['key' => self::M_WITHDRAWS_UPDATE, 'module' => ModuleNameEnum::WITHDRAWS],
        ['key' => self::M_WITHDRAWS_CREATE, 'module' => ModuleNameEnum::WITHDRAWS],
        ['key' => self::M_WITHDRAWS_DELETE, 'module' => ModuleNameEnum::WITHDRAWS],
        ['key' => self::M_WITHDRAWS_MAIN_DATA, 'module' => ModuleNameEnum::WITHDRAWS],

        ['key' => self::M_CLIENTS_INDEX, 'module' => ModuleNameEnum::CLIENTS],
        ['key' => self::M_CLIENTS_INDEX_EXPORT, 'module' => ModuleNameEnum::CLIENTS],
        ['key' => self::M_CLIENTS_CREATE, 'module' => ModuleNameEnum::CLIENTS],
        ['key' => self::M_CLIENTS_UPDATE, 'module' => ModuleNameEnum::CLIENTS],
        ['key' => self::M_CLIENTS_DELETE, 'module' => ModuleNameEnum::CLIENTS],
        ['key' => self::M_CLIENTS_MAIN_DATA, 'module' => ModuleNameEnum::CLIENTS],

    ];


    public static function getModulePermission(ModuleNameEnum $moduleNameEnum): \Illuminate\Support\Collection
    {
        return collect(self::PERMISSIONS)->where('module', $moduleNameEnum);
    }

    /*get abilities by name*/
    public static function getAbilities(): \Illuminate\Support\Collection
    {
        $items = collect(self::PERMISSIONS);
        $response = collect();
        foreach ($items as $item) {
            $response->push([
                'module' => $item['module'],
                'alias' => $item['alias'] ?? $item['module'],
                'key' => $item['key']->value
            ]);
        }
        return $response;
    }
}
