<?php

namespace App\Services;

use App\Models\EwcCode;
use App\Models\Substance;
use Illuminate\Database\Eloquent\Builder;

class Ewc160106CalculationsService
{
    public static function calculateRollingMassAddage(Substance $substance)
    {
        return $substance->mass - ($substance->disposal_mass + $substance->export_mass + $substance->pretreatment_mass + $substance->collector_mass + $substance->on_site_transfer_mass);
    }

    public static function sumMassFromQuery(Builder $query)
    {
        $query = clone $query;
        return $query->whereNotNull("car_id")->sum('mass');
    }

    public static function sumR4DisposalFromQuery(Builder $query)
    {
        $query = clone $query;
        return $query->whereNull("car_id")->sum('mass');
    }

    public static function sumExportsFromQuery($query)
    {
        $query = clone $query;
        $query = $query->whereNull("car_id");
        return ($query->sum("pretreatment_mass") + $query->sum("collector_mass") + $query->sum("disposal_mass") + $query->sum("export_mass") + $query->sum("on_site_transfer_mass"));
    }

    public static function sum160106ToR4($year)
    {
        return Substance::with("ewcCode")
                        ->whereRelation("ewcCode", "code", "=" , "Anyag-R4")
                        ->whereYear("date",$year)
                        ->sum("mass");
    }

    public static function sumNonHazardousSubstances($year)
    {
        return Substance::with("ewcCode")
            ->whereRelation("ewcCode", "hazardous", "=" , false)
            ->whereYear("date",$year)
            ->whereDoesntHave("ewcCode", function ($query){
                return $query->whereIn("code", ["160106","R4","Anyag-R4"]);
            })
            ->sum("mass");
    }

    public static function calculateYearEnd($query,EwcCode $ewcCode, $year)
    {
        $query = clone $query;
        return $ewcCode->getYearlyStarterForYear($year)
               + self::sumMassFromQuery($query)
               + self::sumR4DisposalFromQuery($query)
               - self::sumExportsFromQuery($query)
               - self::sumNonHazardousSubstances($year)
               - self::sum160106ToR4($year);
    }
}
