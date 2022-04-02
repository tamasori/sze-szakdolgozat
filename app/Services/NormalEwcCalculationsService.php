<?php

namespace App\Services;

use App\Models\EwcCode;
use App\Models\Substance;

class NormalEwcCalculationsService
{
    public static function calculateRollingMassAddage(Substance $substance)
    {
        return $substance->mass - ($substance->disposal_mass + $substance->export_mass + $substance->pretreatment_mass + $substance->collector_mass + $substance->on_site_transfer_mass);
    }

    public static function sumMassFromQuery($query)
    {
        $query = clone $query;

        return $query->sum('mass');
    }

    public static function sumExportsFromQuery($query)
    {
        $query = clone $query;

        return ($query->sum("pretreatment_mass") + $query->sum("collector_mass") + $query->sum("disposal_mass") + $query->sum("export_mass") + $query->sum("on_site_transfer_mass"));
    }

    public static function calculateYearEnd($query,EwcCode $ewcCode, $year)
    {
        $query = clone $query;

        return $ewcCode->getYearlyStarterForYear($year) + self::sumMassFromQuery($query) - self::sumExportsFromQuery($query);
    }
}
