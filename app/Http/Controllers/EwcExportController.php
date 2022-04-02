<?php

namespace App\Http\Controllers;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Services\NormalEwcExportService;
use App\Services\Ewc160104ExportService;

class EwcExportController
{
    public function show(EwcCode $ewcCode, $year = null)
    {
        $service = EwcHelpers::getServiceForEwcCode($ewcCode, $year);

        return view('exports.ewc.layout')
            ->with("service", $service)
            ->with("ewcCode", $ewcCode)
            ->with("year", $year);
    }

    public function downloadXlsx(EwcCode $ewcCode, $year = null)
    {
        $service = EwcHelpers::getServiceForEwcCode($ewcCode, $year);

        return $service->exportAsXlsx();
    }

    public function downloadCsv(EwcCode $ewcCode, $year = null)
    {
        $service = EwcHelpers::getServiceForEwcCode($ewcCode, $year);

        return $service->exportAsCsv();
    }

    public function downloadPdf(EwcCode $ewcCode, $year = null)
    {
        $service = EwcHelpers::getServiceForEwcCode($ewcCode, $year);

        return $service->exportAsPdf();
    }
}
