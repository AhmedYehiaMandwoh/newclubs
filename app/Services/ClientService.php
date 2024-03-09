<?php

namespace App\Services;

use App\Enums\SettingsKeysEnum;
use App\Models\Client;
use App\Models\ClientOffer;
use App\Models\Setting;
use Carbon\Carbon;

class ClientService extends BaseService
{
    public function canTakeGift(Client $client): array
    {
        $settings=Setting::query()->where('key',SettingsKeysEnum::WHEEL_ROTATION_TIME)->first()?->value;
        $client_offer= ClientOffer::query()->where('client_id',$client->id)
            ->latest('id')
            ->where('created_at','>',Carbon::now()->subHour($settings))->first();
        $allow_take_gift=true;
        $waiting_by_hour=null;
        if ($client_offer && false){
            $allow_take_gift=false;
            $waiting_by_hour=$client_offer->created_at->addHour($settings)->diffInHours(Carbon::now());
        }
        return [
            'allow_take_gift'=>$allow_take_gift,
            'waiting_by_hour'=>$waiting_by_hour,
        ];
    }
}
