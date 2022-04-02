<?php

namespace App\Exports;

use App\Models\EwcCode;
use App\Helpers\EwcHelpers;
use App\Interfaces\EwcExportInterface;
use App\Services\NormalEwcExportService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class NormalExport implements FromView
{
    use Exportable;

    public $exportService;

    public function __construct(EwcExportInterface $exportService)
    {
        $this->exportService = $exportService;
    }

    public function view() : View
    {
        return $this->exportService->tableView();
    }
}
