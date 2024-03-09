<?php

namespace App\Http\Middleware;

use App\Classes\BaseAction;
use App\Classes\Localization;
use App\Classes\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request): array
    {

        return array_merge(parent::share($request), [
            'locale' => app()->getLocale(),
            'asset_url' => asset('/'),
            'toastr' => $request->session()->get('toastr'),
            'locals' => Localization::getAllLocales(),
            'menu' => Auth::guard('web')->check() ? (new Menu())->getMenu() : (new Menu())->getMenuHospitalityProviders(),
            'links' => [
                'auth' => $request->user() ? 'auth.edit' : 'hospitality_providers.profile.edit',
                'logout' => $request->user() ? 'logout' : 'hospitality_providers.logout',
            ],
            'auth' => [
                'user' => $request->user() ? $request->user() : Auth::guard('hospitality_provider')->user(),
                'abilities' => Auth::guard('web')->check()?$request->user()?->getAbilities()?->pluck('name')->toArray():null,
            ],

        ]);
    }
}
