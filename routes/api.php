<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;
use App\Http\Controllers\Api\v1\PredefinedAnswersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(
    [
        "prefix" => "v1",
        "as" => "v1.",
    ],
    function (){
        Route::post("/login",[\App\Http\Controllers\Api\v1\LoginController::class,"login"])->name("login");
        Route::group(["middleware" => ["auth:sanctum"]], function () {
            Route::get("/zip-decode/{zipcode?}",[\App\Http\Controllers\Api\v1\ZipCodeDecodeController::class,"decode"])->name("zip.decode");
            Route::get("/kuj-decoder/{search?}",[\App\Http\Controllers\Api\v1\KUJDecoderController::class,"search"])->name("kuj.decode");
            Route::get("/kuj-decoder/details/{kuj_number?}",[\App\Http\Controllers\Api\v1\KUJDecoderController::class,"details"])->name("kuj.details");
            Route::delete("cars/delete-file/{file}",[\App\Http\Controllers\Api\v1\CarsController::class,"deleteFile"])->name("cars.delete-file");

            Route::get('/enquiries/open', [\App\Http\Controllers\Api\v1\AppEnquiryController::class, "open"])->name("enquiries.open");
            Route::get('/enquiries/own', [\App\Http\Controllers\Api\v1\AppEnquiryController::class, "own"])->name("enquiries.own");
            Route::post('/enquiries/{enquiry}/take', [\App\Http\Controllers\Api\v1\AppEnquiryController::class, "take"])->name("enquiries.take");
            Route::post('/enquiries/{enquiry}/answer', [\App\Http\Controllers\Api\v1\AppEnquiryController::class, "answer"])->name("enquiries.answer");
        });

        Orion::resource('predefined-answers', PredefinedAnswersController::class);
        Orion::resource('car-makes', \App\Http\Controllers\Api\v1\CarMakesController::class);
        Orion::resource('car-models', \App\Http\Controllers\Api\v1\CarModelsController::class);
        Orion::resource('cars', \App\Http\Controllers\Api\v1\CarsController::class);
        Orion::resource('colors', \App\Http\Controllers\Api\v1\ColorsController::class);
        Orion::resource('customers', \App\Http\Controllers\Api\v1\CustomersController::class);
        Orion::resource('enquiries', \App\Http\Controllers\Api\v1\EnquiriesController::class);
        Orion::resource('ewc-codes', \App\Http\Controllers\Api\v1\EwcCodesController::class);
        Orion::resource('exports', \App\Http\Controllers\Api\v1\ExportsController::class);
        Orion::resource('fuel-types', \App\Http\Controllers\Api\v1\FuelTypesController::class);
        Orion::resource('inspection-records', \App\Http\Controllers\Api\v1\InspectionRecordsController::class);
        Orion::resource('inspectors', \App\Http\Controllers\Api\v1\InspectorsController::class);
        Orion::resource('parts', \App\Http\Controllers\Api\v1\PartsController::class);
        Orion::resource('qualities', \App\Http\Controllers\Api\v1\QualitiesController::class);
        Orion::resource('substances', \App\Http\Controllers\Api\v1\SubstancesController::class);
        Orion::resource('presets', \App\Http\Controllers\Api\v1\PresetsController::class);
        Orion::resource('workshop-machineries', \App\Http\Controllers\Api\v1\WorkshopMachineriesController::class);
    }
);
