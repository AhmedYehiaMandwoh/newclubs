<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::group(['middleware' => ['guest', 'throttle:20']], function () {
        Route::get('/login', [\App\Actions\User\UserLoginAction::class, 'loginForm'])->name('viewLogin');
        Route::post('/login', \App\Actions\User\UserLoginAction::class)->name('login');
    });
    //--------------------------------AUTH middleware--------------------------------

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', \App\Actions\HomeAction::class)->name('home');

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::get('/edit', [\App\Actions\User\UserUpdateProfileAction::class, 'viewForm'])->name('edit');
            Route::post('/update', \App\Actions\User\UserUpdateProfileAction::class)->name('update');
        });


        Route::post('/logout', \App\Actions\User\UserLogoutAction::class)->name('logout');


        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', \App\Actions\User\UserIndexAction::class)->name('index');
            Route::post('/', \App\Actions\User\UserStoreAction::class)->name('store');
            Route::post('/{user}', \App\Actions\User\UserUpdateAction::class)->name('update');

            Route::delete('/{user}', \App\Actions\User\UserDeleteAction::class)->name('delete');

            Route::post('/{user}/edit-custom-permission', \App\Actions\User\UserEditCustomPermissionAction::class)->name('edit-custom-permission');
            Route::delete('/{user}/remove-custom-permission', \App\Actions\User\RemoveCustomPermissionAction::class)->name('remove-custom-permission');


            Route::group(['prefix' => 'profile/{user}', 'as' => 'profile.'], function () {
                Route::get('/', [\App\Actions\User\UserProfileAction::class, 'viewMainData'])->name('main-data');
                Route::get('/edit', [\App\Actions\User\UserProfileAction::class, 'viewEdit'])->name('edit');

            });
        });
        Route::group(['prefix' => 'hospitalityproviders', 'as' => 'hospitalityproviders.'], function () {

            Route::get('/', \App\Actions\Managment\HospitalityProvidersIndexAction::class)->name('index');
            Route::post('/{HospitalityProviders}', \App\Actions\Managment\HospitalityProvidersUpdateAction::class)->name('update');
            Route::delete('/{HospitalityProviders}', \App\Actions\Managment\HospitalityProvidersDeleteAction::class)->name('delete');


            Route::group(['prefix' => 'profile/{hospitalityprovider}', 'as' => 'profile.'], function () {
                Route::get('/', [\App\Actions\Managment\HospitalityProvidersProfileAction::class, 'viewMainData'])->name('main-data');
                Route::get('/edit', [\App\Actions\Managment\HospitalityProvidersProfileAction::class, 'viewEdit'])->name('edit');
                Route::get('/branches', [\App\Actions\Managment\HospitalityProvidersProfileAction::class, 'viewBranches'])->name('branches');

            });

        });
         // Withdraws
        Route::group(['prefix' => 'withdraws','as'=>'withdraws.'],function (){
            Route::get('/',\App\Actions\Withdraws\WithdrawsIndexAction::class)->name('index');
            Route::get('/create',\App\Actions\Withdraws\WithdrawsCreateAction::class)->name('create');
            Route::post('/store',\App\Actions\Withdraws\WithdrawsStoreAction::class)->name('store');
            Route::post('/{withdraw}',\App\Actions\Withdraws\WithdrawsUpdateAction::class)->name('update');
            Route::delete('/{withdraw}',\App\Actions\Withdraws\WithdrawsDeleteAction::class)->name('delete');

            Route::group(['prefix' => 'profile/{withdraw}', 'as' => 'profile.'], function () {
                Route::get('/', [\App\Actions\Withdraws\WithdrawsProfileAction::class, 'viewMainData'])->name('main-data');
                Route::get('/edit', [\App\Actions\Withdraws\WithdrawsProfileAction::class, 'viewEdit'])->name('edit');
                Route::get('/showClients', [\App\Actions\Withdraws\WithdrawsProfileAction::class, 'showClients'])->name('showClients');

            });
        });
         // clients
        Route::group(['prefix' => 'clients','as'=>'clients.'],function (){
            Route::get('/',\App\Actions\Clients\ClientsIndexDashboardAction::class)->name('index');
            Route::post('/{client}',\App\Actions\Clients\ClientsUpdateDashboardAction::class)->name('update');
            Route::delete('/{client}',\App\Actions\Clients\ClientsDeleteDashboardAction::class)->name('delete');

            Route::group(['prefix' => 'profile/{client}', 'as' => 'profile.'], function () {
                Route::get('/', [\App\Actions\Clients\ClientsProfileDashboardAction::class, 'viewMainData'])->name('main-data');
                Route::get('/edit', [\App\Actions\Clients\ClientsProfileDashboardAction::class, 'viewEdit'])->name('edit');

            });
        });
         // Sponsors
        Route::group(['prefix' => 'sponsors','as'=>'sponsors.'],function (){
            Route::get('/',\App\Actions\Sponsors\SponsorsIndexAction::class)->name('index');
            Route::get('/create',\App\Actions\Sponsors\SponsorsCreateAction::class)->name('create');
            Route::post('/store',\App\Actions\Sponsors\SponsorsStoreAction::class)->name('store');
            Route::post('/{sponsor}',\App\Actions\Sponsors\SponsorsUpdateAction::class)->name('update');
            Route::delete('/{sponsor}',\App\Actions\Sponsors\SponsorsDeleteAction::class)->name('delete');

            Route::group(['prefix' => 'profile/{sponsor}', 'as' => 'profile.'], function () {
                Route::get('/', [\App\Actions\Sponsors\SponsorsProfileAction::class, 'viewMainData'])->name('main-data');
                Route::get('/edit', [\App\Actions\Sponsors\SponsorsProfileAction::class, 'viewEdit'])->name('edit');

            });
        });

            // Offers
            Route::group(['prefix' => 'offers','as'=>'offers.'],function (){
                Route::get('/',\App\Actions\Offers\OffersIndexAction::class)->name('index');
                Route::get('/create',\App\Actions\Offers\OffersCreateAction::class)->name('create');
                Route::post('/store',\App\Actions\Offers\OffersStoreAction::class)->name('store');
                Route::post('/{offer}',\App\Actions\Offers\OffersUpdateAction::class)->name('update');
                Route::delete('/{offer}',\App\Actions\Offers\OffersDeleteAction::class)->name('delete');

                Route::group(['prefix' => 'profile/{offer}', 'as' => 'profile.'], function () {
                    Route::get('/', [\App\Actions\Offers\OffersProfileAction::class, 'viewMainData'])->name('main-data');
                    Route::get('/edit', [\App\Actions\Offers\OffersProfileAction::class, 'viewEdit'])->name('edit');

                });
            });

         // Settings
        Route::group(['prefix' => 'settings','as'=>'settings.'],function (){
            Route::get('/',\App\Actions\Settings\SettingsIndexAction::class)->name('index');
            Route::post('/{setting}',\App\Actions\Settings\SettingsUpdateAction::class)->name('update');

        });
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('/', \App\Actions\Role\RoleIndexAction::class)->name('index');
            Route::get('/create', [\App\Actions\Role\RoleStoreAction::class, 'viewForm'])->name('create');
            Route::post('/store', \App\Actions\Role\RoleStoreAction::class)->name('store');
            Route::get('/edit/{role}', [\App\Actions\Role\RoleUpdateAction::class, 'viewForm'])->name('edit');
            Route::put('/update/{role}', \App\Actions\Role\RoleUpdateAction::class)->name('update');

            Route::delete('/{role}', \App\Actions\Role\RoleDeleteAction::class)->name('delete');
        });
    });
    //--------------------------------AUTH middleware--------------------------------


});
