<?php

namespace App\Helpers;

use App\Models\EwcCode;
use App\Services\EwcR4ExportService;
use App\Services\Ewc160104ExportService;
use App\Services\NormalEwcExportService;
use App\Services\Ewc160106ExportService;

class EwcHelpers
{
    public static function getServiceForEwcCode(EwcCode $ewcCode, $year){
        switch ($ewcCode->code) {
            case '160104':
                return new Ewc160104ExportService($ewcCode, $year);
            case '160106':
                return new Ewc160106ExportService($ewcCode, $year);
            case 'R4':
            case 'Anyag-R4':
                return new EwcR4ExportService($year);
            default:
                return new NormalEwcExportService($ewcCode, $year);
        }
    }
}