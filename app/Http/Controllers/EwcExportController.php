<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatterExportStoreRequest;
use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Models\Substance;
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

    public function store(MatterExportStoreRequest $request, EwcCode $ewcCode, $year = null)
    {
        $substance = Substance::create(array_merge($request->validated(), ["from_export" => false, "in_material_balance" => true]));
        return redirect()->route("ewc-export.show", [$ewcCode->code, $year])
            ->with("successes",[__("messages.save_success")]);
    }

    public function delete(EwcCode $ewcCode, $year, Substance $substance)
    {
        $substance->delete();

        return redirect()->route("ewc-export.show", [$ewcCode->code, $year])
            ->with("successes",[__("messages.save_success")]);
    }
}
