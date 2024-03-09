<?php

namespace App\Classes;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Helpmate
{
    public static function unsetArray(&$array, $unset_array)
    {
        foreach ($unset_array as $item) {
            unset($array[$item]);
        }
        return $array;
    }
    public static function updateBollenForApi($value = null, $default_value = null)
    {
        if ($value === null){
            if ($default_value){
                $value=$default_value;
            }
            return $value;
        }

        $value = $value * 1;
        return (boolean) $value;
    }
    public static function getAuthUser(): \App\Models\User|null
    {
        return \Auth::guard('web')->user();
    }

    public static function getAuthHospitalityProvider(): \Illuminate\Contracts\Auth\Authenticatable|\App\Models\HospitalityProvider|null
    {
        return Auth::guard('hospitality_provider')->user();
    }

    public static function getApiAuthTypeClient()
    {
        return Auth::guard('client-api')->user();
    }
    public static function getApiAuth()
    {
        return self::getApiAuthTypeHospitality()??self::getApiAuthTypeClient();
    }

    public static function getApiAuthTypeHospitality()
    {
        return Auth::guard('hospitality-api')->user();
    }
    public static function getAuthUserId(): int|null
    {
        return self::getAuthUser()?->id;
    }

    /*try view array like pagination*/
    public static function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $options['path'] = $options['path'] ?? url()->current();
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public static function toFixed($number, $decimals = 2)
    {
        return number_format($number, $decimals, '.', '') * 1;
    }

    public static function tryDelete($row): bool
    {
        try {
            $row->delete();
        } catch (\Throwable  $e) {
            return false;
        }
        return true;
    }

    public static function tryForceDelete($row): bool
    {
        try {
            $row->forceDelete();
        } catch (\Throwable  $e) {
            return false;
        }
        return true;
    }

    public static function dropColumnIfExist($table, ...$columns): void
    {
        foreach ($columns as $column) {
            if (Schema::hasColumn($table, $column)) {
                Schema::table($table, function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }

    public static function dropConstrainedForeignIdIfExist($table, ...$columns): void
    {
        foreach ($columns as $column) {
            if (Schema::hasColumn($table, $column)) {
                Schema::table($table, function (Blueprint $table) use ($column) {
                    $table->dropConstrainedForeignId($column);
                });
            }
        }
    }

    public static function unsetGet(&$item, $key)
    {
        $value = data_get($item, $key);
        unset($item[$key]);
        return $value;
    }

    public static function createQrFormText($text): string
    {
        return 'data:image/svg+xml;base64,' . base64_encode( QrCode::size(300)->generate($text));
    }
}
