<?php

namespace App\Http\Controllers;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Services\NormalEwcExportService;
use App\Services\Ewc160104ExportService;
use App\Services\WasteStorageExportService;
use App\Services\WasteManagementExportService;
use App\Services\WasteCollectionPointExportService;

class WasteCollectionPointExportController
{
    public function show($year = null)
    {
        $service = new WasteCollectionPointExportService($year);

        return view('exports.waste-collection-point.layout')
            ->with("service", $service)
            ->with("year", $year);
    }

    public function downloadXlsx($year = null)
    {
        $service = new WasteCollectionPointExportService($year);

        return $service->exportAsXlsx();
    }

    public function downloadCsv($year = null)
    {
        $service = new WasteCollectionPointExportService($year);

        return $service->exportAsCsv();
    }

    public function downloadPdf($year = null)
    {
        $service = new WasteCollectionPointExportService($year);

        return $service->exportAsPdf();
    }
}
