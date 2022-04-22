<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\EwcCode;
use Illuminate\Support\Str;
use App\Helpers\EwcHelpers;
use Illuminate\Http\Request;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Writer;
use App\Exports\AllCarDataExport;
use App\Services\EwcR4ExportService;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Ewc160104ExportService;
use App\Services\Ewc160106ExportService;
use App\Exports\ByCityMakeAndModelExport;
use App\Exports\CarStatisticsByMakeExport;
use App\Exports\CarStatisticsByCityExport;
use App\Services\WasteStorageExportService;
use App\Services\MaterialBalanceExportService;
use App\Services\WasteManagementExportService;
use App\Services\WasteCollectionPointExportService;

class FullYearExportController extends Controller
{
    public function __invoke($year)
    {
        $nowSlug = Str::slug(now());
        $relativePath = 'public/years/'.$year.'/'.$nowSlug.'/';
        $folder  = storage_path('app/'.$relativePath);

        //create folder if not exists
        if ( ! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        (new MaterialBalanceExportService($year))->pdfInstance()->save($folder."anyagmerleg.pdf");
        (new WasteStorageExportService($year))->pdfInstance()->save($folder."hulladektarolas.pdf");
        (new WasteManagementExportService($year))->pdfInstance()->save($folder."hulladekgazdalkodas.pdf");
        (new WasteCollectionPointExportService($year))->pdfInstance()->save($folder."hulladekgyujtohelypontok.pdf");

        $ewcCodes = EwcCode::all();
        foreach($ewcCodes as $ewcCode) {
            EwcHelpers::getServiceForEwcCode($ewcCode, $year)->pdfInstance()->save($folder.$ewcCode->code.".pdf");
        }

        $carsThisYear = Car::query()->whereYear('date_of_demolition', $year);

        Excel::store(new AllCarDataExport(clone $carsThisYear), $relativePath."autok.xlsx");
        Excel::store(new CarStatisticsByMakeExport(clone $carsThisYear), $relativePath."markankenti_statisztikak.xlsx");
        Excel::store(new CarStatisticsByCityExport(clone $carsThisYear), $relativePath."varosokenti_statisztikak.xlsx");
        Excel::store(new SalesExport(Carbon::create($year)->startOfYear(), Carbon::create($year)->endOfYear()), $relativePath."eladasi_statisztikak.xlsx");

        //zip files in folder
        $zip = new \ZipArchive();
        $zip->open($folder.$year.'.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folder),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder));
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        return response()->download($folder.$year.'.zip');
    }
}
