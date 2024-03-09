<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::group(['prefix' => 'hospitality_providers', 'as' => 'hospitality_providers.'], function () {

        // ----------------------------HospitalityProviders MiddleWare------------------------------------
        Route::group(['middleware' => 'auth:hospitality_provider'], function () {

            Route::get('/home', \App\Actions\HospitalityProviders\Dashboard\HospitalityProvidersHomeAction::class)->name('homeHospitalityProviders');
            Route::post('/logout', \App\Actions\HospitalityProviders\Dashboard\HospitalityProvidersLogoutAction::class)->name('logout');
            // Profile Edit
            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/edit', [App\Actions\HospitalityProviders\Dashboard\HospitalityProvidersUpdateProfileAction::class, 'viewForm'])->name('edit');
                Route::post('/update', \App\Actions\HospitalityProviders\Dashboard\HospitalityProvidersUpdateProfileAction::class)->name('update');
            });

            // Branches
            Route::group(['prefix' => 'branches', 'as' => 'branches.'], function () {
                Route::get('/', \App\Actions\HospitalityProviders\Dashboard\Branches\BranchIndexAction::class)->name('index');
                Route::get('/create', \App\Actions\HospitalityProviders\Dashboard\Branches\BranchCreateAction::class)->name('create');
                Route::post('/store', \App\Actions\HospitalityProviders\Dashboard\Branches\BranchStoreAction::class)->name('store');
                Route::post('/{branch}', \App\Actions\HospitalityProviders\Dashboard\Branches\BranchUpdateAction::class)->name('update');
                Route::delete('/{branch}', \App\Actions\HospitalityProviders\Dashboard\Branches\BranchDeleteAction::class)->name('delete');

                Route::group(['prefix' => 'profile/{branch}', 'as' => 'profile.'], function () {
                    Route::get('/', [\App\Actions\HospitalityProviders\Dashboard\Branches\BranchesProfileAction::class, 'viewMainData'])->name('main-data');
                    Route::get('/edit', [\App\Actions\HospitalityProviders\Dashboard\Branches\BranchesProfileAction::class, 'viewEdit'])->name('edit');
                    Route::get('/offers', [\App\Actions\HospitalityProviders\Dashboard\Branches\BranchesProfileAction::class, 'viewOffers'])->name('viewOffers');

                });
            });
            Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
                Route::post('/store', \App\Actions\HospitalityProviders\Dashboard\Offers\StoreOffersAction::class)->name('store');
                Route::post('/{offer}', \App\Actions\HospitalityProviders\Dashboard\Offers\OffersUpdateAction::class)->name('update');
                Route::delete('/{offer}', \App\Actions\HospitalityProviders\Dashboard\Offers\OffersDeleteAction::class)->name('delete');

            });

        });
        // ----------------------------HospitalityProviders MiddleWare------------------------------------

        // ----------------------------IsHospitality MiddleWare------------------------------------

        Route::group([], function () {

            Route::get('/register', \App\Actions\HospitalityProviders\HospitalityProvidersRegisterAction::class)->name('HospitalityProvidersRegister');
            Route::get('/login', \App\Actions\HospitalityProviders\HospitalityProvidersLoginAction::class)->name('HospitalityProvidersLogin');
        });

        Route::post('/store', \App\Actions\HospitalityProviders\StoreHospitalityProvidersAction::class)->name('storeHospitalityProviders');
        Route::post('/loginAsRes', \App\Actions\HospitalityProviders\LoginHospitalityProvidersAction::class)->name('postLogin');

        Route::get('/forget-password', \App\Actions\HospitalityProviders\HospitalityProvidersForgetPasswordAction::class)->name('forgetPassword');
        Route::get('reset-admin-password', \App\Actions\HospitalityProviders\ResetHospitalityProvidersPasswordAction::class)->name('reset-password');

        Route::post('/forget', \App\Actions\HospitalityProviders\HospitalityProvidersForgetSendAction::class)->name('forget');
        Route::post('/changePassword', \App\Actions\HospitalityProviders\NewHospitalityProvidersPasswordAction::class)->name('changePassword');
    });
});


