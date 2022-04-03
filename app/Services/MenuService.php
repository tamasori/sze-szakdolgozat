<?php

namespace App\Services;

use App\Models\EwcCode;
use App\Models\Substance;
use Carbon\Carbon;

class MenuService
{
    public static function getYears()
    {
        $minYear = Carbon::createFromTimestamp(strtotime(Substance::query()->min('date')))->year;
        $years = [];
        for ($i = $minYear; $i <= date('Y'); $i++) {
            $years[$i] = $i;
        }
        return array_reverse($years);
    }

    public static function getMenuArray(){
        $menu = [];
        $ewcCodes = EwcCode::orderBy("code")->get();
        foreach (self::getYears() as $year){
            $menu[$year][] = [
                "title" => __("menu.yearly.balance",["year" => $year]),
                "url" => route("material-balance-export.show", $year),
                "icon" => "fa fa-balance-scale",
            ];
            $menu[$year][] = [
                "title" => __("menu.yearly.matter_exports",["year" => $year]),
                "url" => route("matter-export.index",["year" => $year]),
                "icon" => "fas fa-truck",
            ];
            $menu[$year][] = [
                "title" => __("yearly-starters.menu",["year" => $year]),
                "url" => route("yearly-starters.index",["year" => $year]),
                "icon" => "fas fa-play",
            ];
            foreach ($ewcCodes as $ewcCode){
                $menu[$year][] = [
                    "title" => __("menu.yearly.ewc_code",["code" => $ewcCode->code, "year" => $year]),
                    "url" => route("ewc-export.show",[$ewcCode->code, $year]),
                    "icon" => ($ewcCode->hazardous ? "fas fa-exclamation" : "far fa-circle"),
                ];
            }
            $menu[$year][] = [
                "title" => __("logbook-entries.log_types.WASTE_MANAGEMENT") . " {$year}",
                "url" => route("waste-management-export.show",["year" => $year]),
                "icon" => "fas fa-book",
            ];
            $menu[$year][] = [
                "title" => __("logbook-entries.log_types.WASTE_STORAGE") . " {$year}",
                "url" => route("waste-storage-export.show",["year" => $year]),
                "icon" => "fas fa-book",
            ];
            $menu[$year][] = [
                "title" => __("logbook-entries.log_types.WASTE_COLLECTION_POINT") . " {$year}",
                "url" => route("waste-collection-point-export.show",["year" => $year]),
                "icon" => "fas fa-book",
            ];
        }
        return $menu;
    }

}
