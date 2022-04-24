<?php

namespace App\Exports;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Services\NormalEwcExportService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class NormalEwcExport implements FromView
{
    use Exportable;

    public EwcCode $ewcCode;
    public $year;

    public function __construct(EwcCode $ewcCode, $year)
    {
        $this->ewcCode = $ewcCode;
        $this->year = $year;
    }

    public function view() : View
    {
        return EwcHelpers::getServiceForEwcCode($this->ewcCode,  $this->year)->tableView();
    }
}
