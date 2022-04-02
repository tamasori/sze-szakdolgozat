<?php

namespace App\Services;

use App\Exports\NormalEwcExport;
use App\Models\EwcCode;
use App\Models\Substance;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;
use PDF;

class NormalEwcExportService implements \App\Interfaces\EwcExportInterface
{
    private $ewcCode;
    private $year;

    public function __construct(EwcCode $ewcCode, $year = null)
    {
        $this->ewcCode = $ewcCode;
        $this->year = $year ?? date('Y');
    }

    public function query()
    {
        return Substance::where("ewc_code_id", $this->ewcCode->id)
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
        return view('exports.ewc.normal.header', [
            'ewcCode' => $this->ewcCode,
            'year' => $this->year,
        ])->render();
    }

    public function bodyView()
    {
        return view("exports.ewc.normal.body", [
            'ewcCode' => $this->ewcCode,
            'year' => $this->year,
            'substances' => $this->query()->get(),
        ])->render();
    }

    public function footerView()
    {
        return view('exports.ewc.normal.footer', [
            'ewcCode' => $this->ewcCode,
            'year' => $this->year,
            'query' => $this->query(),
        ])->render();
    }

    public function tableView($pdf = false)
    {
        return view('exports.ewc.normal.table', [
            'ewcCode' => $this->ewcCode,
            'year' => $this->year,
            'substances' => $this->query()->get(),
            'query' => $this->query(),
            'service' => $this,
            'pdf' => $pdf,
        ]);
    }

    public function exportAsXlsx()
    {
        return (new NormalEwcExport($this->ewcCode,$this->year))
            ->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.xlsx');
    }

    public function exportAsCsv()
    {
        return (new NormalEwcExport($this->ewcCode,$this->year))
            ->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportAsPdf()
    {
        $pdf = LaravelMpdf::loadHTML($this->tableView(true)->render());
        return $pdf->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.pdf');
    }
}
