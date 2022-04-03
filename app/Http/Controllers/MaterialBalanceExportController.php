<?php

namespace App\Http\Controllers;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Services\NormalEwcExportService;
use App\Services\Ewc160104ExportService;
use App\Services\WasteManagementExportService;
use App\Services\MaterialBalanceExportService;

class MaterialBalanceExportController
{
    public function show($year = null)
    {
        $service = new MaterialBalanceExportService($year);

        return view('exports.material-balance.layout')
            ->with("service", $service)
            ->with("year", $year);
    }

    public function downloadXlsx($year = null)
    {
        abort(400);
    }

    public function downloadCsv($year = null)
    {
        abort(400);
    }

    public function downloadPdf($year = null)
    {
        $service = new MaterialBalanceExportService($year);

        return $service->exportAsPdf();
    }
}
