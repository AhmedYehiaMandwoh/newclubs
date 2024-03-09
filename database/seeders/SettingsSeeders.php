<?php

namespace Database\Seeders;

use App\Enums\SettingsKeysEnum;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSettings();
    }

    public function createSettings(): void
    {
        $settings = [
            ['key' => SettingsKeysEnum::WHEEL_ROTATION_TIME->value, 'value' => '180'],
            ['key' => SettingsKeysEnum::TERMS_AND_CONDITIONS->value, 'value' => null],
        ];

        foreach ($settings as $value) {
            Setting::firstOrCreate(['key' => $value['key']], ['value' => $value['value']]);
        }
    }
}
