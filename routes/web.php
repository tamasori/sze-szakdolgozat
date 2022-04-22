<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth routes
Route::group([
    "middleware" => "guest",
    "as" => "auth."
], function (){
    Route::get("login", [\App\Http\Controllers\Auth\LoginController::class,"index"])->name("login");
    Route::post("login", [\App\Http\Controllers\Auth\LoginController::class,"login"])->name("login.post");
    Route::get("reset-password", [\App\Http\Controllers\Auth\ResetPasswordController::class,"index"])->name("reset-password");
    Route::post("reset-password", [\App\Http\Controllers\Auth\ResetPasswordController::class,"resetPassword"])->name("reset-password.post");
});

Route::group([
    "middleware" => "auth",
],function (){

    Route::get("logout", \App\Http\Controllers\Auth\LogoutController::class)->name("logout");

    //Dashboard route
    Route::get("dashboard", [\App\Http\Controllers\DashboardController::class,"index"])->name("dashboard");

    Route::resource("car",\App\Http\Controllers\CarsController::class);

    Route::resource("ewc-code",\App\Http\Controllers\EwcCodesController::class);

    Route::resource("customers",\App\Http\Controllers\CustomersController::class);

    Route::resource("enquiries",\App\Http\Controllers\EnquiriesController::class);

    Route::resource("preset",\App\Http\Controllers\PresetsController::class);

    Route::resource("machines",\App\Http\Controllers\MachinesController::class);

    Route::resource("inspector",\App\Http\Controllers\InspectorsController::class);

    Route::resource("inspection-record",\App\Http\Controllers\InspectionRecordsController::class);

    Route::resource("logbook-entry",\App\Http\Controllers\LogbookEntriesController::class)->except(["show"]);

    Route::view("sales", "sales.index")->name("sales.index");

    Route::get("matter-export/{year}",[\App\Http\Controllers\MatterExportsController::class,"index"])->name("matter-export.index");
    Route::post("matter-export/{year}/store",[\App\Http\Controllers\MatterExportsController::class,"store"])->name("matter-export.store");
    Route::get("matter-export/{year}/{substance}/edit",[\App\Http\Controllers\MatterExportsController::class,"edit"])->name("matter-export.edit");
    Route::get("matter-export/{year}/create",[\App\Http\Controllers\MatterExportsController::class,"create"])->name("matter-export.create");
    Route::put("matter-export/{year}/{substance}/update",[\App\Http\Controllers\MatterExportsController::class,"update"])->name("matter-export.update");
    Route::delete("matter-export/{year}/{substance}",[\App\Http\Controllers\MatterExportsController::class,"destroy"])->name("matter-export.destroy");

    Route::get("yearly-starters/{year}",[\App\Http\Controllers\YearlyStartersController::class,"index"])->name("yearly-starters.index");
    Route::post("yearly-starters/{year}/store",[\App\Http\Controllers\YearlyStartersController::class,"store"])->name("yearly-starters.store");

    Route::get("ewc-export/{ewcCode:code}/{year}",[\App\Http\Controllers\EwcExportController::class,"show"])->name("ewc-export.show");
    Route::get("ewc-export/{ewcCode:code}/{year}/xlsx",[\App\Http\Controllers\EwcExportController::class,"downloadXlsx"])->name("ewc-export.xlsx");
    Route::get("ewc-export/{ewcCode:code}/{year}/csv",[\App\Http\Controllers\EwcExportController::class,"downloadCsv"])->name("ewc-export.csv");
    Route::get("ewc-export/{ewcCode:code}/{year}/pdf",[\App\Http\Controllers\EwcExportController::class,"downloadPdf"])->name("ewc-export.pdf");

    Route::get("waste-management-export/{year}",[\App\Http\Controllers\WasteManagementExportController::class,"show"])->name("waste-management-export.show");
    Route::get("waste-management-export/{year}/xlsx",[\App\Http\Controllers\WasteManagementExportController::class,"downloadXlsx"])->name("waste-management-export.xlsx");
    Route::get("waste-management-export/{year}/csv",[\App\Http\Controllers\WasteManagementExportController::class,"downloadCsv"])->name("waste-management-export.csv");
    Route::get("waste-management-export/{year}/pdf",[\App\Http\Controllers\WasteManagementExportController::class,"downloadPdf"])->name("waste-management-export.pdf");

    Route::get("waste-storage-export/{year}",[\App\Http\Controllers\WasteStorageExportController::class,"show"])->name("waste-storage-export.show");
    Route::get("waste-storage-export/{year}/xlsx",[\App\Http\Controllers\WasteStorageExportController::class,"downloadXlsx"])->name("waste-storage-export.xlsx");
    Route::get("waste-storage-export/{year}/csv",[\App\Http\Controllers\WasteStorageExportController::class,"downloadCsv"])->name("waste-storage-export.csv");
    Route::get("waste-storage-export/{year}/pdf",[\App\Http\Controllers\WasteStorageExportController::class,"downloadPdf"])->name("waste-storage-export.pdf");

    Route::get("waste-collection-point-export/{year}",[\App\Http\Controllers\WasteCollectionPointExportController::class,"show"])->name("waste-collection-point-export.show");
    Route::get("waste-collection-point-export/{year}/xlsx",[\App\Http\Controllers\WasteCollectionPointExportController::class,"downloadXlsx"])->name("waste-collection-point-export.xlsx");
    Route::get("waste-collection-point-export/{year}/csv",[\App\Http\Controllers\WasteCollectionPointExportController::class,"downloadCsv"])->name("waste-collection-point-export.csv");
    Route::get("waste-collection-point-export/{year}/pdf",[\App\Http\Controllers\WasteCollectionPointExportController::class,"downloadPdf"])->name("waste-collection-point-export.pdf");

    Route::get("material-balance-export/{year}",[\App\Http\Controllers\MaterialBalanceExportController::class,"show"])->name("material-balance-export.show");
    Route::get("material-balance-export/{year}/pdf",[\App\Http\Controllers\MaterialBalanceExportController::class,"downloadPdf"])->name("material-balance-export.pdf");

    Route::resource("predefined-answer", \App\Http\Controllers\PredefinedAnswersController::class)->except(["show", "update", "create", "edit"]);

    Route::get("download-whole-year/{year}",\App\Http\Controllers\FullYearExportController::class)->name("download-whole-year");

    Route::resource('user', \App\Http\Controllers\UserController::class)->except(["show"]);

    //Redirections
    Route::redirect('/',"dashboard");
});
