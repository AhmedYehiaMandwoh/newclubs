<?php

use App\Actions\Apis\ClientHospitality;
use App\Actions\Apis\Clients;
use App\Actions\Apis\HospitalityProviders;
use App\Actions\Apis\Public\TermsAndConditionsAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('terms_and_conditions',TermsAndConditionsAction::class);
Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('/register', Clients\ClientRegisterAction::class)->name('register');
        Route::post('/login', ClientHospitality\ClientHospitalityLoginAction::class)->name('login');
    });

    Route::group(['middleware' => 'authClientOrHospitality'], function () {
        Route::get('/logout', ClientHospitality\ClientHospitalityLogoutAction::class)->name('logout');

        Route::get('/get-auth-user', Clients\ClientsUserAction::class);
        Route::post('/auth-user-update', Clients\ClientsUpdateAction::class);
    });

    Route::group(['middleware' => 'auth:client-api'], function () {
        Route::post('/branch/{branch}', Clients\ClientGetBranchOffersAction::class);

        Route::post('/save-win-offers', Clients\ClientsOwnedWheelOffersAction::class);
        Route::post('/offers-filtered', Clients\ClientOffersAction::class);
        Route::post('/move-offer/{clientOffer}', Clients\ClientMoveOfferAction::class);
//        Route::post('/client-win-offer', Clients\ClientWinOffer::class)->name('client-win-offer');


    });

    Route::group(['prefix' => 'providers'],function (){
        Route::get('/index', Clients\Providers\ProvidersIndexAction::class);
        Route::get('/get-filter-data', [Clients\Providers\ProvidersIndexAction::class,'getFilterData']);
    });

    Route::group(['middleware' => 'auth:hospitality-api'], function () {
        Route::group(['prefix' => 'branches'], function () {
            Route::get('/', HospitalityProviders\Branches\GetBranchesApiAction::class);
            Route::post('/', HospitalityProviders\Branches\StoreBranchApiAction::class);
            Route::post('/{branch}/update', HospitalityProviders\Branches\UpdateBranchApiAction::class);
            Route::delete('/{branch}', HospitalityProviders\Branches\DeleteBranchApiAction::class);
        });

        Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
            Route::get('/branch/{branch}', HospitalityProviders\Offers\OffersIndexAction::class);
            Route::get('/get-create-update-data', [HospitalityProviders\Offers\StoreOffersAction::class, 'getCreateUpdateData']);
            Route::post('/store/branch/{branch}', HospitalityProviders\Offers\StoreOffersAction::class);
            Route::post('/{offer}/update', HospitalityProviders\Offers\OffersUpdateAction::class);
            Route::delete('/{offer}/delete', HospitalityProviders\Offers\OffersDeleteAction::class);
        });
        Route::group(['prefix' => 'provider'],function (){
            Route::group(['prefix' => 'client-offer'],function (){
                Route::post('/{clientOffer}/use', HospitalityProviders\ClientOfferUseAction::class);
            });
        });
    });


});


