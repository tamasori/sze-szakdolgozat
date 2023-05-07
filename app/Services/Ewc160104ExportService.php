<?php

namespace App\Services;

use App\Models\Car;
use App\Exports\NormalEwcExport;
use App\Models\EwcCode;
use App\Models\Substance;
use App\Scopes\ExcludeSpecialEwcCodeFromSubstancesScope;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;
use PDF;

class Ewc160104ExportService implements \App\Interfaces\EwcExportInterface
{
    private $ewcCode;
    private $year;

    public function __construct(EwcCode $ewcCode, $year = null)
    {
        $this->ewcCode = $ewcCode;
        $this->year    = $year ?? date('Y');
    }

    public function query()
    {
        return Substance::withoutGlobalScopes()->with("car")->where("ewc_code_id", $this->ewcCode->id)
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
            'year'    => $this->year,
        ])->render();
    }

    public function bodyView()
    {
        return view("exports.ewc.160104.body", [
            'ewcCode'                  => $this->ewcCode,
            'year'                     => $this->year,
            'substances'               => $this->query()->get(),
            'hazardousSubstancesByCar' => Substance::selectRaw("car_id, SUM(mass) as mass")
                                                   ->hazardous()
                                                    ->withGlobalScope('exclude', new ExcludeSpecialEwcCodeFromSubstancesScope())
                                                   ->whereYear("date", $this->year)
                                                   ->whereIn("car_id", Car::query()
                                                                          ->whereYear("date_of_demolition", $this->year)
                                                                          ->pluck("id"))
                                                   ->groupBy("car_id")
                                                   ->pluck("mass", "car_id")
                                                   ->toArray(),
        ])->render();
    }

    public function footerView()
    {
        return view('exports.ewc.160104.footer', [
            'ewcCode' => $this->ewcCode,
            'year'    => $this->year,
            'query'   => $this->query(),
            'hazardousSubstancesByCar' => Substance::selectRaw("car_id, SUM(mass) as mass")
                                                   ->hazardous()
                                                   ->whereYear("date", $this->year)
                ->withGlobalScope('exclude', new ExcludeSpecialEwcCodeFromSubstancesScope())
                                                   ->whereIn("car_id", Car::query()
                                                                          ->whereYear("date_of_demolition", $this->year)
                                                                          ->pluck("id"))
                                                   ->groupBy("car_id")
                                                   ->pluck("mass", "car_id")
                                                   ->toArray(),
        ])->render();
    }

    public function tableView($pdf = false)
    {
        return view('exports.ewc.normal.table', [
            'ewcCode'    => $this->ewcCode,
            'year'       => $this->year,
            'substances' => $this->query()->get(),
            'query'      => $this->query(),
            'service'    => $this,
            'pdf'        => $pdf,
        ]);
    }

    public function exportAsXlsx()
    {
        return (new NormalEwcExport($this->ewcCode, $this->year))
            ->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.xlsx');
    }

    public function exportAsCsv()
    {
        return (new NormalEwcExport($this->ewcCode, $this->year))
            ->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function pdfInstance(): \Meneses\LaravelMpdf\LaravelMpdf
    {
        return LaravelMpdf::loadHTML($this->tableView(true)->render());
    }

    public function exportAsPdf()
    {
        $pdf = $this->pdfInstance();

        return $pdf->download('ewc_'.$this->ewcCode->code.'_'.$this->year.'.pdf');
    }
}
