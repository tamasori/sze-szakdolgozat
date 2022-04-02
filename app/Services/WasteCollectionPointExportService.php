<?php

namespace App\Services;

use App\Models\Car;
use App\Models\LogbookEntry;
use App\Exports\NormalExport;
use App\Exports\NormalEwcExport;
use App\Models\EwcCode;
use App\Models\Substance;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;
use PDF;

class WasteCollectionPointExportService implements \App\Interfaces\EwcExportInterface
{
    private $year;

    public function __construct($year = null)
    {
        $this->year = $year ?? date('Y');
    }

    public function query()
    {
        return Substance::withoutGlobalScopes()
                        ->with("ewcCode")
                        ->whereYear("date", $this->year)
                        ->orderBy("date")
                        ->orderBy("created_at");
    }

    public function pdfStyles()
    {
        return view('exports.ewc.normal.pdf-styles')->render();
    }

    public function headerView()
    {
        return view('exports.waste-collection-point.header', [
            'year' => $this->year,
        ])->render();
    }

    public function bodyView()
    {
        return view("exports.waste-collection-point.body", [
            'year'       => $this->year,
            'substances' => $this->query()->get(),
            'query'      => $this->query(),
        ])->render();
    }

    public function footerView()
    {
        return view('exports.waste-management.footer', [
            'year'                        => $this->year,
            'logbookEntriesNormal'        => LogbookEntry::query()
                                                         ->whereYear("date", $this->year)
                                                         ->where("log_type", "=", "WASTE_COLLECTION_POINT")
                                                         ->where("check_type", "=", "NORMAL")
                                                         ->orderBy("date")
                                                         ->get(),
            'logbookEntriesExtraordinary' => LogbookEntry::query()
                                                         ->whereYear("date", $this->year)
                                                         ->where("log_type", "=", "WASTE_COLLECTION_POINT")
                                                         ->where("check_type", "=", "EXTRAORDINARY")
                                                         ->orderBy("date")
                                                         ->get(),
        ])->render();
    }

    public function tableView($pdf = false)
    {
        return view('exports.ewc.normal.table', [
            'service' => $this,
            'pdf'     => $pdf,
        ]);
    }

    public function exportAsXlsx()
    {
        return (new NormalExport($this))
            ->download('hulladekgyujtohelypontok_'.$this->year.'.xlsx');
    }

    public function exportAsCsv()
    {
        return (new NormalExport($this))
            ->download('hulladekgyujtohelypontok_'.$this->year.'.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportAsPdf()
    {
        $pdf = LaravelMpdf::loadHTML($this->tableView(true)->render());

        return $pdf->download('hulladekgyujtohelypontok_'.$this->year.'.pdf');
    }
}
