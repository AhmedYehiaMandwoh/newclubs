<?php

namespace App\Actions\Settings;


use App\Classes\{Abilities, BaseAction};
use App\Enums\{ModuleNameEnum};
use App\Models\Setting;
use Inertia\Inertia;

class SettingsIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SETTINGS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Setting::query()->latest('id')->search(['name']);
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Settings/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SETTINGS), 'url' => route('settings.index')],
            ...$append_breadcrumb
        ]);
    }


}
