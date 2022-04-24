<?php

namespace App\Http\Controllers;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Services\NormalEwcExportService;
use App\Services\Ewc160104ExportService;
use App\Services\WasteManagementExportService;

class WasteManagementExportController
{
    public function show($year = null)
    {
        $service = new WasteManagementExportService($year);

        return view('exports.waste-management.layout')
            ->with("service", $service)
            ->with("year", $year);
    }

    public function downloadXlsx($year = null)
    {
        $service = new WasteManagementExportService($year);

        return $service->exportAsXlsx();
    }

    public function downloadCsv($year = null)
    {
        $service = new WasteManagementExportService($year);

        return $service->exportAsCsv();
    }

    public function downloadPdf($year = null)
    {
        $service = new WasteManagementExportService($year);

        return $service->exportAsPdf();
    }
}
