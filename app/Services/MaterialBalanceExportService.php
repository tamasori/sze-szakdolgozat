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

class MaterialBalanceExportService implements \App\Interfaces\EwcExportInterface
{
    private $year;

    public function __construct($year = null)
    {
        $this->year = $year ?? date('Y');
    }

    public function query()
    {
        return \DB::table("substances")
                  ->selectRaw("SUM(mass) as mass_sum, SUM(export_mass) as export_mass_sum, SUM(pretreatment_mass) as pretreatment_mass_sum, SUM(disposal_mass) as disposal_mass_sum, SUM(collector_mass) as collector_mass_sum, SUM(on_site_transfer_mass) as on_site_transfer_mass_sum, ewc_codes.code")
                  ->join("ewc_codes", "ewc_codes.id", "=", "substances.ewc_code_id")
                  ->where("substances.in_material_balance", true)
                  ->whereYear("substances.date", $this->year)
                  ->groupBy("ewc_codes.code");
    }

    public function pdfStyles()
    {
        return view('exports.ewc.normal.pdf-styles')->render();
    }

    public function headerView()
    {
        return "";
    }

    public function bodyView()
    {
        $sumEwcCodes = [];
        $sums = $this->query()->get();

        foreach ($sums as $sum){
            $sumEwcCodes[$sum->code] = floatval($sum->mass_sum) - floatval($sum->export_mass_sum) -floatval($sum->pretreatment_mass_sum) - floatval($sum->disposal_mass_sum) - floatval($sum->collector_mass_sum) - floatval($sum->on_site_transfer_mass_sum);
        }


        return view("exports.material-balance.body", [
            'year'       => $this->year,
            'substances' => $sumEwcCodes,
        ])->render();
    }

    public function footerView()
    {
        return "";
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
        return null;
    }

    public function exportAsCsv()
    {
        return null;
    }

    public function pdfInstance(): \Meneses\LaravelMpdf\LaravelMpdf
    {
        return LaravelMpdf::loadHTML($this->tableView(true)->render());
    }

    public function exportAsPdf()
    {
        $pdf = $this->pdfInstance();

        return $pdf->download('anyagmerleg_'.$this->year.'.pdf');
    }
}
