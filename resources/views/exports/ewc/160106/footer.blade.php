<table class="table table-hover table-bordered w-auto">
    <tbody>
    <tr>
        <td class="text-bold">@lang("exports.ewc.normal.table.footer.starter", ["year" => $year])</td>
        <td>{{ $ewcCode->getYearlyStarterForYear($year) }} kg</td>
    </tr>
    <tr style="border-top: 3px solid black;">
        <td class="text-bold">@lang("exports.ewc.normal.table.footer.mass", ["year" => $year])</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sumMassFromQuery($query) }} kg</td>
        <td rowspan="2"
            style="vertical-align: middle;">@lang("exports.ewc.160106.footer.total_generated",["year" => $year, "mass" => \App\Services\Ewc160106CalculationsService::sumMassFromQuery($query)+\App\Services\Ewc160106CalculationsService::sumR4DisposalFromQuery($query)])</td>
    </tr>
    <tr>
        <td class="text-bold">@lang("exports.ewc.160106.footer.r4_disposal")</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sumR4DisposalFromQuery($query) }} kg</td>
    </tr>
    <tr style="border-top: 3px solid black;">
        <td class="text-bold">@lang("exports.ewc.160106.footer.exported_mass", ["year" => $year])</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sumExportsFromQuery($query) }} kg</td>
        <td rowspan="4" style="vertical-align: middle;">@lang("exports.ewc.160106.footer.total_exported",
                                                                ["year" => $year,
                                                                "mass" => \App\Services\Ewc160106CalculationsService::sumExportsFromQuery($query)
                                                                + \App\Services\Ewc160106CalculationsService::sumNonHazardousSubstances($year)
                                                                + \App\Services\Ewc160106CalculationsService::sum160106ToR4($year)])</td>

    </tr>
    <tr>
        <td class="text-bold">@lang("exports.ewc.160106.footer.non_hazardous")</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sumNonHazardousSubstances($year) }} kg</td>
    </tr>
    <tr>
        <td class="text-bold">@lang("exports.ewc.160106.footer.160106_to_r4")</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sum160106ToR4($year) }} kg</td>
    </tr>
    <tr>
        <td class="text-bold">@lang("exports.ewc.160106.footer.before_2017")</td>
        <td>0 kg</td>
    </tr>
    <tr style="border-top: 3px solid black;">
        <td class="text-bold">@lang("exports.ewc.normal.table.footer.sum", ["year" => $year])</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::calculateYearEnd($query, $ewcCode, $year) }} kg</td>
    </tr>
    <tr>
        <td class="text-bold">@lang("exports.ewc.160106.footer.extra_sum", ["year" => $year])</td>
        <td>{{ \App\Services\Ewc160106CalculationsService::sumMassFromQuery($query) }} kg</td>
    </tr>
    </tbody>
</table>
